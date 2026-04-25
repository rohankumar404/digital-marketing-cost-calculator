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
        $currencySymbols = [ 'USD' => '$', 'INR' => '₹', 'EUR' => '€', 'GBP' => '£', 'AED' => 'د.إ', 'SAR' => 'ر.س', 'QAR' => 'ر.ق', 'KWD' => 'د.ك' ];
        $currencyRates = [ 'USD' => 1, 'INR' => 83.2, 'EUR' => 0.92, 'GBP' => 0.79, 'AED' => 3.67, 'SAR' => 3.75, 'QAR' => 3.64, 'KWD' => 0.31 ];
        
        $currencySymbol = $currencySymbols[$targetCurrency] ?? '$';
        $conversionRate = $currencyRates[$targetCurrency] ?? 1;

        // Custom formatter for the PDF view
        $formatCurrency = function($amt) use ($currencySymbol, $conversionRate, $targetCurrency) {
            $val = ($amt ?? 0) * $conversionRate;
            $decimals = ($targetCurrency === 'KWD' ? 3 : 0);
            return $currencySymbol . number_format($val, $decimals);
        };

        // 1. Generate PDF
        $pdf = Pdf::loadView('pdf.proposal', compact('calculation', 'formatCurrency', 'targetCurrency'));
        
        // 2. Define storage path
        $fileName = 'proposal_' . $calculationId . '_' . Str::random(8) . '.pdf';
        $path = 'proposals/' . $fileName;

        // 3. Save to storage
        Storage::disk('public')->put($path, $pdf->output());

        // 4. Record in database
        $proposal = Proposal::create([
            'user_id'        => auth()->id(),
            'calculation_id' => $calculation->id,
            'file_path'      => $path,
        ]);

        // 5. Stream download or return URL
        return $pdf->download('Mapsily_Marketing_Proposal.pdf');
    }
}
