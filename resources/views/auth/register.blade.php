<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Create Account</h2>
        <p class="text-gray-500 text-sm">Join to unlock unlimited reports and strategy insights.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Google OAuth --}}
        <div class="mb-8">
            <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-3 w-full py-3 px-4 bg-white hover:bg-gray-100 text-gray-900 font-bold rounded-xl transition-all duration-300 shadow-lg shadow-white/5">
                <svg width="20" height="20" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/><path fill="none" d="M0 0h48v48H0z"/>
                </svg>
                Sign up with Google
            </a>

            <div class="relative flex items-center justify-center mt-6">
                <div class="border-t border-gray-800 w-full"></div>
                <span class="absolute px-4 bg-[#1a1a1a] text-xs text-gray-600 uppercase tracking-widest font-bold">OR</span>
            </div>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Business Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-800 text-center">
            <p class="text-sm text-gray-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-brand font-semibold hover:underline">Log in here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
