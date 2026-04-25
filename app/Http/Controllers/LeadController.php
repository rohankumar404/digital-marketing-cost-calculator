<?php

namespace App\Http\Controllers;

use App\Mail\InternalLeadNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    /**
     * Store a new strategic lead.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        // Save to DB
        \App\Models\Lead::create(array_merge($validated, ['type' => 'growth_solution']));

        // Send internal notification
        Mail::to('leads@mapsily.com')->send(new InternalLeadNotification($validated));

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Our expert will contact you shortly.'
        ]);
    }
}
