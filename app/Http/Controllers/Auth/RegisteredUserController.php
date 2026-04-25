<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store code
        \App\Models\EmailVerificationCode::create([
            'email' => $user->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(10)
        ]);

        // Send Email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\VerificationCodeMail($code));

        // Store user ID in session temporarily to know who is verifying
        session(['pending_user_id' => $user->id]);

        return redirect()->route('verification.code');
    }
}
