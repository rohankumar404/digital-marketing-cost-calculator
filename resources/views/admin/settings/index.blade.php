@extends('layouts.admin')

@section('page_title', 'General Tool Settings')

@section('admin_content')
<div class="max-w-4xl">
<div class="max-w-4xl space-y-8">
    {{-- Main Settings Form --}}
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="space-y-8">
            {{-- Branding Section --}}
            <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Branding & Identity
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tool Title</label>
                        <input type="text" name="tool_title" value="{{ $settings['tool_title'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tool Tagline</label>
                        <input type="text" name="tool_tagline" value="{{ $settings['tool_tagline'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                </div>
            </div>

            {{-- Functional Settings --}}
            <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.77 3.77z"/></svg>
                    Functional Controls
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Main CTA Button Text</label>
                        <input type="text" name="main_cta_text" value="{{ $settings['main_cta_text'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lead Notification Email</label>
                        <input type="email" name="lead_notification_email" value="{{ $settings['lead_notification_email'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Support Email</label>
                        <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Footer Copyright</label>
                        <input type="text" name="footer_copyright" value="{{ $settings['footer_copyright'] ?? '' }}" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-4 py-3 focus:border-[var(--primary)] focus:ring-0">
                    </div>
                </div>
            </div>

            {{-- Aesthetics & Finance --}}
            <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
                    Aesthetics & Finance
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Primary Color</label>
                        <div class="flex gap-3">
                            <input type="color" name="primary_color" value="{{ $settings['primary_color'] ?? '#85f43a' }}" class="h-12 w-20 bg-[#111] border-gray-800 rounded-lg cursor-pointer">
                            <input type="text" value="{{ $settings['primary_color'] ?? '#85f43a' }}" readonly class="flex-1 bg-[#111] border-gray-800 text-gray-400 rounded-lg px-4 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Background Color</label>
                        <div class="flex gap-3">
                            <input type="color" name="background_color" value="{{ $settings['background_color'] ?? '#1a1a1a' }}" class="h-12 w-20 bg-[#111] border-gray-800 rounded-lg cursor-pointer">
                            <input type="text" value="{{ $settings['background_color'] ?? '#1a1a1a' }}" readonly class="flex-1 bg-[#111] border-gray-800 text-gray-400 rounded-lg px-4 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Global Default Currency</label>
                        <select name="default_currency" class="w-full h-12 bg-[#111] border-gray-800 text-white rounded-lg px-4 focus:border-[var(--primary)] focus:ring-0">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->code }}" {{ ($settings['default_currency'] ?? '') == $currency->code ? 'selected' : '' }}>
                                    {{ $currency->code }} ({{ $currency->symbol }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="text-black font-extrabold px-10 py-4 rounded-xl shadow-lg transition active:scale-95" style="background-color: var(--primary)">
                    Save General Settings
                </button>
            </div>
        </div>
    </form>

    {{-- Currency Management Section (OUTSIDE MAIN FORM) --}}
    <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white flex items-center gap-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Available Currencies
            </h3>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- List Currencies --}}
            <div class="lg:col-span-2 overflow-hidden rounded-xl border border-gray-800">
                <table class="w-full text-left text-sm">
                    <thead class="bg-black/20 text-gray-400 text-xs uppercase">
                        <tr>
                            <th class="p-4">Code</th>
                            <th class="p-4">Symbol</th>
                            <th class="p-4">Rate (to USD)</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($currencies as $currency)
                        <tr class="hover:bg-white/5 transition">
                            <td class="p-4 font-bold text-white">{{ $currency->code }}</td>
                            <td class="p-4 font-bold" style="color: var(--primary)">{{ $currency->symbol }}</td>
                            <td class="p-4 text-gray-400">{{ number_format($currency->rate, 4) }}</td>
                            <td class="p-4 text-right">
                                @if(!$currency->is_default)
                                    <form action="{{ route('admin.settings.currency.delete', $currency->id) }}" method="POST" onsubmit="return confirm('Delete this currency?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-400 text-xs font-bold">Delete</button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-gray-600 uppercase font-bold">System Default</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Currency Form --}}
            <div class="bg-[#242424] p-6 rounded-xl border border-gray-800 h-fit">
                <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">Add New Currency</h4>
                <form action="{{ route('admin.settings.currency.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Currency Code (e.g. GBP)</label>
                        <input type="text" name="code" required placeholder="GBP" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-3 py-2 text-sm focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Symbol (e.g. £)</label>
                        <input type="text" name="symbol" required placeholder="£" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-3 py-2 text-sm focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Exchange Rate (1 USD = ?)</label>
                        <input type="number" step="0.0001" name="rate" required placeholder="0.79" class="w-full bg-[#111] border-gray-800 text-white rounded-lg px-3 py-2 text-sm focus:border-[var(--primary)] focus:ring-0">
                    </div>
                    <button type="submit" class="w-full text-black font-extrabold py-3 rounded-lg text-xs uppercase tracking-widest hover:scale-[1.02] transition" style="background-color: var(--primary)">
                        Add Currency
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
