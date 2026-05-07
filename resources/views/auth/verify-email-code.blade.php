<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white">Verify Your Email</h2>
        <p class="text-gray-500 text-sm mt-2">We've sent a 6-digit code to <span class="text-brand">{{ $email }}</span>. Enter it below to activate your account.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-400 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf

        <!-- Verification Code -->
        <div>
            <x-input-label for="code" :value="__('Verification Code')" class="text-center" />
            <x-text-input id="code" 
                          class="block mt-2 w-full text-center text-3xl font-bold tracking-widest py-4 border-2 focus:border-brand" 
                          type="text" 
                          name="code" 
                          maxlength="6"
                          required 
                          autofocus 
                          autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2 text-center" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-4 text-lg">
                {{ __('Verify & Activate') }}
            </x-primary-button>
        </div>

    </form>

    <div class="mt-8 pt-6 border-t border-gray-800 text-center">
        <div class="text-xs text-gray-500">
            Didn't receive the code? 
            <form id="resend-form" method="POST" action="{{ route('verification.resend') }}" class="inline">
                @csrf
                <button type="submit" class="text-brand hover:underline focus:outline-none">
                    Resend Code
                </button>
            </form>
            <span class="mx-1 text-gray-700">|</span>
            <a href="{{ route('register') }}" class="text-brand hover:underline">Try registering again</a>
        </div>
    </div>
</x-guest-layout>
