@extends('layouts.admin')

@section('page_title', 'General Tool Settings')

@section('admin_content')
<div class="max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="space-y-8">
            {{-- Branding Section --}}
            <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85f43a" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Branding & Identity
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tool Title</label>
                        <input type="text" name="tool_title" value="{{ $settings['tool_title'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tool Tagline</label>
                        <input type="text" name="tool_tagline" value="{{ $settings['tool_tagline'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                </div>
            </div>

            {{-- Functional Settings --}}
            <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85f43a" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.77 3.77z"/></svg>
                    Functional Controls
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Main CTA Button Text</label>
                        <input type="text" name="main_cta_text" value="{{ $settings['main_cta_text'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lead Notification Email</label>
                        <input type="email" name="lead_notification_email" value="{{ $settings['lead_notification_email'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Support Email</label>
                        <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Footer Copyright</label>
                        <input type="text" name="footer_copyright" value="{{ $settings['footer_copyright'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[#85f43a] focus:ring-0">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#85f43a] text-black font-extrabold px-10 py-4 rounded-xl shadow-lg shadow-[#85f43a]/20 hover:scale-[1.02] transition active:scale-95">
                    Save General Settings
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
