@extends('layouts.admin')

@section('page_title', 'Lead Management')

@section('admin_content')
<div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 overflow-hidden">
    <div class="p-6 border-b border-gray-800 flex justify-between items-center">
        <h3 class="font-bold">Total Strategic Leads ({{ $leads->total() }})</h3>
        <a href="{{ route('admin.leads.export') }}" class="bg-white text-black px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-[#85f43a] transition">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
            Export to CSV
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-black/20 text-gray-400 text-xs uppercase">
                    <th class="p-4">Contact Info</th>
                    <th class="p-4">Company</th>
                    <th class="p-4">Lead Type</th>
                    <th class="p-4">Linked Calculation</th>
                    <th class="p-4">Date Captured</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($leads as $lead)
                <tr class="hover:bg-white/5 transition">
                    <td class="p-4">
                        <div class="font-bold text-white">{{ $lead->name ?? 'Guest User' }}</div>
                        <div class="text-xs text-gray-500">{{ $lead->email }}</div>
                        @if($lead->phone)
                            <div class="text-xs text-[#85f43a]">{{ $lead->phone }}</div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="text-sm text-gray-300 font-medium">{{ $lead->company ?? 'N/A' }}</div>
                        @if($lead->message)
                            <div class="text-[10px] text-gray-500 max-w-xs truncate cursor-help" title="{{ $lead->message }}">"{{ $lead->message }}"</div>
                        @endif
                    </td>
                    <td class="p-4 text-xs">
                        <span class="px-2 py-1 rounded bg-gray-800 text-gray-400 capitalize">
                            {{ str_replace('_', ' ', $lead->type) }}
                        </span>
                    </td>
                    <td class="p-4">
                        @if($lead->calculation)
                        <a href="{{ route('calculations.show', $lead->calculation_id) }}" class="text-xs text-brand hover:underline">
                            View Quote #${{ $lead->calculation_id }}
                        </a>
                        @else
                        <span class="text-xs text-gray-600">Manual Entry</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-gray-500">{{ $lead->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 bg-black/10 border-t border-gray-800">
        {{ $leads->links() }}
    </div>
</div>
@endsection
