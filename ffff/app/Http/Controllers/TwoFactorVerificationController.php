<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Hash;
use PragmaRX\Google2FALaravel\Support\Constants;
use App\Models\LoginHistory;

class TwoFactorVerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify');
    }

    public function resend(Request $request)
    {

        $user = auth()->user();
        $user->sendTwoFactorAuthenticationCode();
        return redirect('/verify')->with('success', 'Two-factor authentication code has been resent.');

    }

    public function verify(Request $request)
    {
        $user = auth()->user();
        $google2fa = new Google2FA();

        // if ($google2fa->verifyKey($user->google2fa_secret, $request->input('code'))) {
        if (Hash::check($request->input('code'), $user->google2fa_secret)) {
            LoginHistory::create([
                'header' => $request->header('User-Agent'),
                'location' => $request->ip(),
                'user_id' => $user->id,
            ]);
            $user->resetTwoFactorAuthenticationCode();
            return redirect()->intended('/'); // Adjust the redirect path as needed
        }

        // TOTP is invalid, redirect back to verification page with an error message
        return redirect('/verify')->withErrors(['code' => 'Invalid authentication code']);
    }

}
