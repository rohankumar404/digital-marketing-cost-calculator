<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Show the general settings page.
     */
    public function index()
    {
        $settings = GeneralSetting::all()->pluck('value', 'key');
        $currencies = \App\Models\Currency::all();
        return view('admin.settings.index', compact('settings', 'currencies'));
    }

    /**
     * Add a new currency.
     */
    public function addCurrency(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:currencies,code',
            'symbol' => 'required',
            'rate' => 'required|numeric'
        ]);

        \App\Models\Currency::create($request->all());
        \Illuminate\Support\Facades\Cache::forget("all_currencies");

        return redirect()->back()->with('success', 'Currency added successfully.');
    }

    /**
     * Delete a currency.
     */
    public function deleteCurrency($id)
    {
        $currency = \App\Models\Currency::findOrFail($id);
        if ($currency->is_default) {
            return redirect()->back()->with('error', 'Cannot delete default currency.');
        }
        $currency->delete();
        \Illuminate\Support\Facades\Cache::forget("all_currencies");
        return redirect()->back()->with('success', 'Currency deleted successfully.');
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            GeneralSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            \Illuminate\Support\Facades\Cache::forget("setting.$key");
        }

        return redirect()->back()->with('success', 'General settings updated successfully.');
    }
}
