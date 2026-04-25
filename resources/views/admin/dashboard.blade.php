@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('admin_content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-[#1a1a1a] p-6 rounded-2xl border border-gray-800">
        <p class="text-gray-400 text-sm mb-2">Total Users</p>
        <p class="text-3xl font-bold text-[#85f43a]">{{ $stats['total_users'] }}</p>
    </div>
    <div class="bg-[#1a1a1a] p-6 rounded-2xl border border-gray-800">
        <p class="text-gray-400 text-sm mb-2">Total Leads</p>
        <p class="text-3xl font-bold text-[#85f43a]">{{ $stats['total_leads'] }}</p>
    </div>
    <div class="bg-[#1a1a1a] p-6 rounded-2xl border border-gray-800">
        <p class="text-gray-400 text-sm mb-2">Calculations Run</p>
        <p class="text-3xl font-bold text-[#85f43a]">{{ $stats['total_calcs'] }}</p>
    </div>
</div>

<div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 overflow-hidden">
    <div class="p-6 border-b border-gray-800 flex justify-between items-center">
        <h3 class="font-bold">Recent Leads</h3>
        <a href="{{ route('admin.leads') }}" class="text-[#85f43a] text-sm hover:underline">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-black/20 text-gray-400 text-xs uppercase">
                    <th class="p-4">Name/Email</th>
                    <th class="p-4">Company</th>
                    <th class="p-4">Type</th>
                    <th class="p-4">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($stats['recent_leads'] as $lead)
                <tr class="hover:bg-white/5 transition">
                    <td class="p-4">
                        <div class="font-bold">{{ $lead->name ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500">{{ $lead->email }}</div>
                    </td>
                    <td class="p-4 text-sm text-gray-300">{{ $lead->company ?? 'N/A' }}</td>
                    <td class="p-4 text-xs">
                        <span class="px-2 py-1 rounded bg-gray-800 text-gray-400 capitalize">{{ str_replace('_', ' ', $lead->type) }}</span>
                    </td>
                    <td class="p-4 text-sm text-gray-500">{{ $lead->created_at->format('M d, H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
