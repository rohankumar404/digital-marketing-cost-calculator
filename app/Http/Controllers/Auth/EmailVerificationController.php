<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerificationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    /**
     * Show the verification code form.
     */
    public function show()
    {
        if (!session('pending_user_id')) {
            return redirect()->route('register');
        }
        
        $user = User::findOrFail(session('pending_user_id'));
        return view('auth.verify-email-code', ['email' => $user->email]);
    }

    /**
     * Verify the code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        if (!session('pending_user_id')) {
            return redirect()->route('register');
        }

        $user = User::findOrFail(session('pending_user_id'));

        $verification = EmailVerificationCode::where('email', $user->email)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'The code is invalid or has expired.']);
        }

        // Verify user
        $user->email_verified_at = now();
        $user->save();

        // Delete code
        $verification->delete();

        // Login user
        Auth::login($user);

        // Clear pending session
        session()->forget('pending_user_id');

        return redirect()->route('dashboard');
    }

    /**
     * Resend the verification code.
     */
    public function resend(Request $request)
    {
        if (!session('pending_user_id')) {
            return redirect()->route('register');
        }

        $user = User::findOrFail(session('pending_user_id'));

        // Delete old codes
        EmailVerificationCode::where('email', $user->email)->delete();

        // Generate 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store code
        EmailVerificationCode::create([
            'email' => $user->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(10)
        ]);

        // Send Email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\VerificationCodeMail($code));

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}
