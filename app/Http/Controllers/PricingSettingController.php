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
        return view('admin.pricing.index', compact('settings'));
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
