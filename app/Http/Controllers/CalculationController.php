<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\CalculationService;
use App\Services\CostCalculatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculationController extends Controller
{
    protected $calculator;

    public function __construct(CostCalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * Handle the submission of the calculator form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_type'   => 'required|string',
            'industry'        => 'required|string',
            'target_location' => 'required|string',
            'growth_stage'    => 'required|string',
            'monthly_revenue' => 'nullable|numeric',
            'services'        => 'required|array|min:1',
            'inputs'          => 'required|array',
        ]);

        // 1. Run the intensive calculation logic
        $revenue = $validated['monthly_revenue'] ? (float)$validated['monthly_revenue'] : null;
        $results = $this->calculator->calculate($validated['inputs'], $revenue, $validated['growth_stage']);

        // 2. Persist to database
        return DB::transaction(function () use ($validated, $results) {
            $calculation = Calculation::create([
                'user_id'         => auth()->id(), // returns null if guest
                'business_type'   => $validated['business_type'],
                'industry'        => $validated['industry'],
                'target_location' => $validated['target_location'],
                'monthly_revenue' => $validated['monthly_revenue'],
                'growth_stage'    => $validated['growth_stage'],
                'total_cost'      => $results['total_cost'],
                'roi_range'       => $results['roi_range'],
                'budget_recommendation' => $results['budget_recommendation'],
                'strategy_suggestion'   => $results['strategy_suggestion'],
            ]);

            // Track usage for logged-in users
            if (auth()->check()) {
                \App\Models\UsageLimit::track(auth()->id());
            }

            // Save individual service inputs and costs
            // ... (rest of store method) ...
            foreach ($results['breakdown'] as $detail) {
                // Find matching input key
                $serviceKey = $this->matchServiceKey($detail['name']);
                
                CalculationService::create([
                    'calculation_id' => $calculation->id,
                    'service_name'   => $detail['name'],
                    'inputs'         => $validated['inputs'][$serviceKey] ?? [],
                    'estimated_cost' => $detail['cost'],
                ]);
            }

            return response()->json([
                'success'    => true,
                'calculation_id' => $calculation->id,
                'total_cost' => $results['total_cost'],
                'breakdown'  => $results['breakdown'],
                'roi_range'  => $results['roi_range'],
                'budget_recommendation' => $results['budget_recommendation'],
                'strategy_suggestion'   => $results['strategy_suggestion'],
                'redirect_url' => route('calculations.show', $calculation->id)
            ]);
        });
    }

    /**
     * Display the results dashboard.
     */
    public function show($id)
    {
        $calculation = Calculation::with('services')->findOrFail($id);
        
        $isGuest = !auth()->check();
        $isOverLimit = false;

        if (!$isGuest) {
            $limit = auth()->user()->usageLimit;
            $isOverLimit = ($limit && $limit->usage_count > 3);
        }

        return view('calculator.results', [
            'calculation' => $calculation,
            'isGuest' => $isGuest,
            'isOverLimit' => $isOverLimit,
            'chartData' => $calculation->services->map(fn($s) => [
                'name' => $s->service_name,
                'cost' => $s->estimated_cost
            ])
        ]);
    }

    /**
     * Map friendly names back to input keys.
     */
    private function matchServiceKey(string $name): string
    {
        return match (true) {
            str_contains($name, 'SEO') && !str_contains($name, 'Local') => 'seo',
            str_contains($name, 'Google Ads') => 'google_ads',
            str_contains($name, 'Social Media') => 'social',
            str_contains($name, 'Website') => 'website',
            str_contains($name, 'Local SEO') => 'local_seo',
            str_contains($name, 'Email') => 'email',
            str_contains($name, 'Content') => 'content',
            default => strtolower(str_replace(' ', '_', $name))
        };
    }
}
