<?php

namespace App\Services;

use App\Models\PricingSetting;

class CostCalculatorService
{
    /**
     * Calculate the total digital marketing cost and breakdown based on inputs.
     *
     * @param array $inputs The structured JSON inputs from the frontend.
     * @param float|null $monthlyRevenue Optional revenue for ROI calculation.
     * @param string|null $growthStage Optional growth stage for budget recommendation.
     * @return array
     */
    public function calculate(array $inputs, ?float $monthlyRevenue = null, ?string $growthStage = null): array
    {
        $breakdown = [];
        $totalCost = 0;

        // 1. SEO
        if (isset($inputs['seo']) && !empty($inputs['seo']['keywords'])) {
            $cost = $this->calculateSeo($inputs['seo']);
            $breakdown[] = ['name' => 'SEO', 'cost' => $cost, 'icon' => '🔍'];
            $totalCost += $cost;
        }

        // 2. Google Ads
        if (isset($inputs['google_ads']) && !empty($inputs['google_ads']['budget'])) {
            $cost = $this->calculateGoogleAds($inputs['google_ads']);
            $breakdown[] = ['name' => 'Google Ads', 'cost' => $cost, 'icon' => '⚡'];
            $totalCost += $cost;
        }

        // 3. Social Media
        if (isset($inputs['social']) && !empty($inputs['social']['platforms'])) {
            $cost = $this->calculateSocialMedia($inputs['social']);
            $breakdown[] = ['name' => 'Social Media', 'cost' => $cost, 'icon' => '📱'];
            $totalCost += $cost;
        }

        // 4. Website Development (Amortized over 12 months for monthly view)
        if (isset($inputs['website']) && !empty($inputs['website']['pages'])) {
            $cost = $this->calculateWebsite($inputs['website']);
            $monthlyCost = round($cost / 12);
            $breakdown[] = ['name' => 'Website Development (Amortized)', 'cost' => $monthlyCost, 'icon' => '🌐'];
            $totalCost += $monthlyCost;
        }

        // 5. Local SEO
        if (isset($inputs['local_seo']) && !empty($inputs['local_seo']['locations'])) {
            $cost = $this->calculateLocalSeo($inputs['local_seo']);
            $breakdown[] = ['name' => 'Local SEO', 'cost' => $cost, 'icon' => '📍'];
            $totalCost += $cost;
        }

        // 6. Email Marketing
        if (isset($inputs['email']) && !empty($inputs['email']['list_size'])) {
            $cost = $this->calculateEmailMarketing($inputs['email']);
            $breakdown[] = ['name' => 'Email Marketing', 'cost' => $cost, 'icon' => '📧'];
            $totalCost += $cost;
        }

        // 7. Content Marketing
        if (isset($inputs['content']) && !empty($inputs['content']['articles_per_month'])) {
            $cost = $this->calculateContentMarketing($inputs['content']);
            $breakdown[] = ['name' => 'Content Marketing', 'cost' => $cost, 'icon' => '✍️'];
            $totalCost += $cost;
        }

        /* ROI projection */
        $roiRange = null;
        if ($monthlyRevenue && $totalCost > 0) {
            $roiLow  = round(($monthlyRevenue * 0.15) / $totalCost, 1);
            $roiHigh = round(($monthlyRevenue * 0.35) / $totalCost, 1);
            $roiRange = "{$roiLow}x – {$roiHigh}x";
        }

        /* Budget recommendation based on growth stage */
        $budgetRecommendation = null;
        $strategySuggestion = null;

        if ($monthlyRevenue && $growthStage) {
            $range = match($growthStage) {
                'Awareness' => [0.15, 0.25],
                'Growth'    => [0.10, 0.18],
                'Scale'     => [0.05, 0.12],
                default     => [0.10, 0.15]
            };

            $strategySuggestion = match($growthStage) {
                'Awareness' => "Strategy focus: 60% Ads, 20% Social, 20% Content. Objective: Targeted visibility.",
                'Growth'    => "Strategy focus: 40% Ads, 40% SEO, 20% Social. Objective: Steady conversion.",
                'Scale'     => "Strategy focus: 50% SEO, 30% Ads, 20% CRO. Objective: Market dominance & efficiency.",
                default     => null
            };
            
            $curr = '₹'; 
            $minRec = number_format($monthlyRevenue * $range[0]);
            $maxRec = number_format($monthlyRevenue * $range[1]);
            $budgetRecommendation = "You should invest {$curr}{$minRec}–{$curr}{$maxRec} monthly";
        }

        return [
            'total_cost'            => $totalCost,
            'breakdown'             => $breakdown,
            'roi_range'             => $roiRange,
            'budget_recommendation' => $budgetRecommendation,
            'strategy_suggestion'   => $strategySuggestion,
            'min_budget'            => round($totalCost * 0.9),
            'max_budget'            => round($totalCost * 1.2),
        ];
    }

    private function calculateSeo(array $data): float
    {
        $keywords = (int)$data['keywords'];
        $pages = (int)($data['pages'] ?? 5);
        $competition = strtolower($data['competition_level'] ?? 'medium');

        $costPerKeyword = (float)(PricingSetting::findSetting('SEO', 'cost_per_keyword') ?: 10);
        $costPerPage = (float)(PricingSetting::findSetting('SEO', 'cost_per_page') ?: 120);
        $baseFee = (float)(PricingSetting::findSetting('SEO', 'base_fee') ?: 400);

        // Competition multiplier
        $multiplierKey = 'multiplier_' . $competition;
        $multiplier = (float)(PricingSetting::findSetting('SEO', $multiplierKey) ?: ($competition === 'high' ? 1.5 : ($competition === 'low' ? 0.8 : 1.0)));

        return round(($keywords * $costPerKeyword + $pages * $costPerPage + $baseFee) * $multiplier);
    }

    private function calculateGoogleAds(array $data): float
    {
        $budget = (float)$data['budget'];
        $feePct = (float)(PricingSetting::findSetting('Google Ads', 'management_fee_pct') ?: 18) / 100;

        $managementFee = $budget * $feePct;
        return round($budget + $managementFee);
    }

    private function calculateSocialMedia(array $data): float
    {
        $postsPerWeek = (int)($data['posts_per_week'] ?: 3);
        $platforms = count($data['platforms'] ?: []);
        $paidBudget = (float)($data['paid_budget'] ?: 0);

        $costPerPost = (float)(PricingSetting::findSetting('Social Media', 'cost_per_post') ?: 50);
        $baseFee = (float)(PricingSetting::findSetting('Social Media', 'base_fee') ?: 300);

        // 4 weeks in a month
        $monthlyPosts = $postsPerWeek * 4;
        
        // Multiplier for multiple platforms (e.g., 20% extra per additional platform)
        $platformMultiplier = 1 + (($platforms - 1) * 0.2);

        return round(($monthlyPosts * $costPerPost * $platformMultiplier) + $baseFee + $paidBudget);
    }

    private function calculateWebsite(array $data): float
    {
        $pages = (int)($data['pages'] ?: 5);
        $type = $data['project_type'] ?: 'New Build';
        
        $typeKey = 'base_cost_' . str_replace(' ', '_', strtolower($type));
        $baseCost = (float)(PricingSetting::findSetting('Website', $typeKey) ?: match($type) {
            'New Build'    => 3500,
            'Redesign'     => 2500,
            'Landing Page' => 800,
            'eCommerce'    => 5500,
            default        => 3000
        });

        $costPerPage = (float)(PricingSetting::findSetting('Website', 'cost_per_page') ?: 180);
        
        // Features add-on (simplified)
        $featuresCount = count($data['features'] ?? []);
        $featureCost = $featuresCount * 250;

        return round($baseCost + ($pages * $costPerPage) + $featureCost);
    }

    private function calculateLocalSeo(array $data): float
    {
        $locations = (int)($data['locations'] ?: 1);
        $setupRequested = (bool)($data['gbp_setup'] ?? false);

        $costPerLocation = (float)(PricingSetting::findSetting('Local SEO', 'cost_per_location') ?: 350);
        $setupFee = $setupRequested ? (float)(PricingSetting::findSetting('Local SEO', 'gbp_setup_fee') ?: 200) : 0;

        return round(($locations * $costPerLocation) + $setupFee);
    }

    private function calculateEmailMarketing(array $data): float
    {
        $listSize = (int)($data['list_size'] ?: 1000);
        $freq = (int)($data['emails_per_month'] ?: 4);

        $costPerContact = (float)(PricingSetting::findSetting('Email Marketing', 'cost_per_contact') ?: 0.012);
        $costPerCampaign = (float)(PricingSetting::findSetting('Email Marketing', 'cost_per_campaign') ?: 80);
        $baseFee = (float)(PricingSetting::findSetting('Email Marketing', 'base_fee') ?: 150);

        return round(($listSize * $costPerContact) + ($freq * $costPerCampaign) + $baseFee);
    }

    private function calculateContentMarketing(array $data): float
    {
        $articles = (int)($data['articles_per_month'] ?: 2);
        $words = (int)($data['word_count'] ?: 1200);

        $costPerWord = (float)(PricingSetting::findSetting('Content Marketing', 'cost_per_word') ?: 0.06);
        $baseFee = (float)(PricingSetting::findSetting('Content Marketing', 'base_fee') ?: 200);

        return round(($articles * $words * $costPerWord) + $baseFee);
    }
}
