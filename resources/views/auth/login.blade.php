<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
        <p class="text-gray-500 text-sm">Sign in to manage your saved estimations.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-dark-lighter text-brand shadow-sm focus:ring-brand" name="remember">
                <span class="ms-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-8">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-brand transition" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-800 text-center">
            <p class="text-sm text-gray-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-brand font-semibold hover:underline">Register for free</a>
            </p>
        </div>
    </form>
</x-guest-layout>
