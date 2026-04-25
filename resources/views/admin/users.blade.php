@extends('layouts.admin')

@section('page_title', 'User Management')

@section('admin_content')
<div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 overflow-hidden">
    <div class="p-6 border-b border-gray-800 flex justify-between items-center">
        <h3 class="font-bold">Registered Platform Users ({{ $users->total() }})</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-black/20 text-gray-400 text-xs uppercase">
                    <th class="p-4">User</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Joined Date</th>
                    <th class="p-4">Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($users as $user)
                <tr class="hover:bg-white/5 transition">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center font-bold text-[#85f43a]">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-white">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @if($user->email_verified_at)
                            <span class="px-2 py-1 rounded-full bg-green-500/10 text-green-500 text-[10px] font-bold uppercase tracking-wider">Verified</span>
                        @else
                            <span class="px-2 py-1 rounded-full bg-yellow-500/10 text-yellow-500 text-[10px] font-bold uppercase tracking-wider">Pending</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="p-4 text-xs font-bold">
                        @if($user->is_admin)
                            <span class="text-[#85f43a]">Administrator</span>
                        @else
                            <span class="text-gray-500">Regular User</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 bg-black/10 border-t border-gray-800">
        {{ $users->links() }}
    </div>
</div>
@endsection
