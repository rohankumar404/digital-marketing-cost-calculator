@extends('layouts.admin')

@section('page_title', 'Global Pricing Rules')

@section('admin_content')
<form action="{{ route('admin.pricing.update') }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="grid grid-cols-1 gap-8">
        {{-- Section: Service Rates --}}
        <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85f43a" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                Base Service Rates
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($settings as $setting)
                    @if(str_contains($setting->key_name, 'cost') || str_contains($setting->key_name, 'fee') || str_contains($setting->key_name, 'rate'))
                        <div class="bg-[#242424] p-5 rounded-xl border border-gray-800">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                                <span class="text-[#85f43a]">{{ $setting->service_name }}</span> - {{ str_replace('_', ' ', $setting->key_name) }}
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">{{ $symbol }}</span>
                                <input type="number" name="settings[{{ $setting->id }}]" value="{{ $setting->value }}" class="w-full bg-[#111] border-gray-800 text-[#85f43a] font-bold rounded-lg pl-8 pr-4 py-3 focus:border-[#85f43a] focus:ring-0">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Section: Multipliers --}}
        <div class="bg-[#1a1a1a] rounded-2xl border border-gray-800 p-8">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#85f43a" stroke-width="2"><path d="M12 2v20M2 12h20"/><path d="M17 7l-5 5-5-5"/></svg>
                Complexity Multipliers
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($settings as $setting)
                    @if(str_contains($setting->key_name, 'multiplier'))
                        <div class="bg-[#242424] p-5 rounded-xl border border-gray-800">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                                <span class="text-[#85f43a]">{{ $setting->service_name }}</span> - {{ str_replace('_', ' ', $setting->key_name) }}
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">x</span>
                                <input type="number" step="0.1" name="settings[{{ $setting->id }}]" value="{{ $setting->value }}" class="w-full bg-[#111] border-gray-800 text-[#85f43a] font-bold rounded-lg pl-8 pr-4 py-3 focus:border-[#85f43a] focus:ring-0">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-[#85f43a] text-black font-extrabold px-10 py-4 rounded-xl shadow-lg shadow-[#85f43a]/20 hover:scale-[1.02] transition active:scale-95">
                Save Global Pricing Rules
            </button>
        </div>
    </div>
</form>
@endsection
