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
     * Update admin profile (Email and Password).
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);
        
        // Verify current password
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match our records.');
        }
        
        // Update Email
        $user->email = $request->email;
        
        // Update Password if provided
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'Admin security credentials updated successfully.');
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
