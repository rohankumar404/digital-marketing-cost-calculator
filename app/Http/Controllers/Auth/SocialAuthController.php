<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google consent screen.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Unable to authenticate with Google.']);
        }

        // Find or create user
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Update existing user with Google ID and Avatar if not set
            $user->update([
                'google_id' => $user->google_id ?? $googleUser->getId(),
                'avatar'    => $user->avatar ?? $googleUser->getAvatar(),
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            // Create new user with verified status (Google verified it)
            $user = User::create([
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'google_id'         => $googleUser->getId(),
                'avatar'            => $googleUser->getAvatar(),
                'password'          => Hash::make(Str::random(24)),
                'email_verified_at' => now(), // Professional fast-track for social login
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        }
    }
}
