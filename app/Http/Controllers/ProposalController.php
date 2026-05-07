<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProposalController extends Controller
{
    /**
     * Generate and download the PDF proposal.
     */
    public function store(Request $request, $calculationId)
    {
        $calculation = Calculation::with('services')->findOrFail($calculationId);

        // Required email for guests
        if (!auth()->check()) {
            $request->validate([
                'email' => 'required|email'
            ]);
            
            \App\Models\Lead::create([
                'email' => $request->email,
                'calculation_id' => $calculation->id
            ]);
        }

        // 1. Currency logic
        $targetCurrency = $request->input('currency', 'USD');
        $allCurrencies = \App\Models\Currency::all();
        
        $currency = $allCurrencies->where('code', $targetCurrency)->first() ?: $allCurrencies->where('is_default', true)->first();
        
        $currencyCode = $currency ? $currency->code : 'USD';
        $conversionRate = $currency ? $currency->rate : 1;

        // Custom formatter for the PDF view
        $formatCurrency = function($amt) use ($currencyCode, $conversionRate, $targetCurrency) {
            $val = ($amt ?? 0) * $conversionRate;
            $decimals = ($targetCurrency === 'KWD' ? 3 : 0);
            return $currencyCode . ' ' . number_format($val, $decimals);
        };

        // 2. Branding logic for PDF
        $primaryColor = get_setting('primary_color', '#85f43a');
        $backgroundColor = get_setting('background_color', '#1a1a1a'); // Match previous branding defaults

        // 1. Generate PDF
        $pdf = Pdf::loadView('pdf.proposal', compact('calculation', 'formatCurrency', 'targetCurrency', 'primaryColor', 'backgroundColor'));
        
        // 2. Define storage path
        $fileName = 'proposal_' . $calculationId . '_' . Str::random(8) . '.pdf';
        $directory = 'proposals';
        $path = $directory . '/' . $fileName;

        try {
            // 3. Ensure directory exists
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // 4. Save to storage
            Storage::disk('public')->put($path, $pdf->output());

            // 5. Record in database
            $proposal = Proposal::create([
                'user_id'        => auth()->id(),
                'calculation_id' => $calculation->id,
                'file_path'      => $path,
            ]);
        } catch (\Exception $e) {
            \Log::error('PDF Storage Failed: ' . $e->getMessage());
            // We can still try to download it even if saving fails
        }

        // 6. Stream download
        return $pdf->download('Mapsily_Marketing_Proposal.pdf');
    }
}
