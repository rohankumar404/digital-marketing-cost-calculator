<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use App\Models\Calculation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_users'  => User::count(),
            'total_leads'  => Lead::count(),
            'total_calcs'  => Calculation::count(),
            'recent_leads' => Lead::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * List all leads.
     */
    public function leads()
    {
        $leads = Lead::with('calculation')->latest()->paginate(20);
        return view('admin.leads', compact('leads'));
    }

    /**
     * List all users.
     */
    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Export leads to CSV (Simple implementation).
     */
    public function exportLeads()
    {
        $leads = Lead::all();
        $csvHeader = ['ID', 'Name', 'Email', 'Phone', 'Company', 'Type', 'Created At'];
        
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="mapsily_leads_'.date('Y-m-d').'.csv"');
        
        fputcsv($handle, $csvHeader);
        
        foreach ($leads as $lead) {
            fputcsv($handle, [
                $lead->id,
                $lead->name ?? 'N/A',
                $lead->email,
                $lead->phone ?? 'N/A',
                $lead->company ?? 'N/A',
                $lead->type,
                $lead->created_at
            ]);
        }
        
        fclose($handle);
        exit;
    }
}
