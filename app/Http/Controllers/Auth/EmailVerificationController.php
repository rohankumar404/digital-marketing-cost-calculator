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
}
