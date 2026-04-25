<?php

namespace App\Http\Controllers;

use App\Models\PricingSetting;
use Illuminate\Http\Request;

class PricingSettingController extends Controller
{
    /**
     * Show the admin dashboard for pricing.
     */
    public function index()
    {
        $settings = PricingSetting::all();
        
        // Group settings by service for better UI
        $grouped = $settings->groupBy('service_name');

        return view('admin.pricing.index', compact('grouped'));
    }

    /**
     * Bulk update pricing settings.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'required|numeric'
        ]);

        foreach ($data['settings'] as $id => $value) {
            PricingSetting::where('id', $id)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pricing settings updated successfully.');
    }
}
