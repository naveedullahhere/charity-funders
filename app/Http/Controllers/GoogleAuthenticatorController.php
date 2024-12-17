<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PragmaRX\Google2FA\Support\Constants;
use PragmaRX\Google2FAQRCode\Google2FA;
// use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer\ImageWriter;
use BaconQrCode\Common\ErrorCorrectionLevel;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\CustomGoogle2FA;
use ParagonIE\ConstantTime\Base32;
use Illuminate\Http\JsonResponse;
use App\Models\LoginHistory;

use Illuminate\Support\Facades\Hash;


class GoogleAuthenticatorController extends Controller
{
    public function showSetupForm(Request $request)
    {
        date_default_timezone_set('Asia/Karachi');

        $google2fa = app('pragmarx.google2fa');

        // Generate a new secret key
        $secretKey = $google2fa->generateSecretKey();

        // Encrypt the secret key before storing it
        $encryptedSecretKey = encrypt($secretKey);

        // Store the encrypted secret key in the user model
        // auth()->user()->update(['google2fa_secret' => $encryptedSecretKey]);
        $otp = $google2fa->getCurrentOtp($secretKey);
        $twoFa = new Google2FA();

        $QR_Image = $twoFa->getQRCodeInline(
            config('app.name'),
            auth()->user()->email,
            $secretKey
        );

        $response = [
            'QR_Image' => $QR_Image,
            'otp' => $otp,
            'secret' => $secretKey,
            'encryptedSecretKey' => $encryptedSecretKey,
        ];

        if ($request->ajax()) {
            return response()->json(['data' => view('auth.setup-google-authenticator-ajax', $response)->render()]);
        }

        return view('auth.setup-google-authenticator', $response);
    }

    public function asciiToBase32($asciiSecretKey)
    {
        $base32SecretKey = Base32::encodeUpper($asciiSecretKey);
        return rtrim($base32SecretKey, '='); // Remove padding
    }

    public function verifyCode(Request $request)
    {
        // Validate the form input

        $user = auth()->user();

        // Decrypt the stored secret key
        $decryptedSecretKey = decrypt($user->google2fa_secret);


        // Create a new instance of Google2FA
        $google2fa = app(Google2FA::class);
        $encryptedSecretKey=$user->google2fa_secret;
        // Verify the provided code
        $isValidCode = $google2fa->verifyKey($decryptedSecretKey, $request->input('2fa_code'));

        // Check if the code is valid
        if ($isValidCode) {
            LoginHistory::create([
                'header' => $request->header('User-Agent'),
                'location' => $request->ip(),
                'user_id' => $user->id,
            ]);
            auth()->user()->update(
                [
                    'google2fa_secret' => $encryptedSecretKey,
                    'security' => 2,
                    'can_login' => 1
                ]
            );
            return response()->json(['success' => 'Google Authenticator set up successfully!']);
        } else {
            return response()->json(['error' => 'Invalid Google Authenticator code. Please try again.'], 422);
        }
    }

    public function verifySetup(Request $request)
    {
        // Validate the form input

        $user = auth()->user();

        // Decrypt the stored secret key
        $decryptedSecretKey = decrypt($request->encryptedSecretKey);


        // Create a new instance of Google2FA
        $google2fa = app(Google2FA::class);
        $encryptedSecretKey=$request->encryptedSecretKey;
        // Verify the provided code
        $isValidCode = $google2fa->verifyKey($decryptedSecretKey, $request->input('2fa_code'));

        // Check if the code is valid
        if ($isValidCode) {
            auth()->user()->update(
                [
                    'google2fa_secret' => $encryptedSecretKey,
                    'security' => 2
                ]
            );
            return response()->json(['success' => 'Google Authenticator set up successfully!']);
        } else {
            return response()->json(['error' => 'Invalid Google Authenticator code. Please try again.'], 422);
        }
    }

    public function showDisableForm()
    {
        return view('auth.disable-google-authenticator');
    }

    public function disableGoogle2FA(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->input('password'), auth()->user()->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        auth()->user()->update([
            'google2fa_enabled' => false,
            'google2fa_secret' => null,
        ]);

        return redirect()->route('home')->with('success', 'Google Authenticator disabled successfully.');
    }

    private function customBase32Encode($string)
    {
        $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $base32 = '';
        $add = 0;
        $shift = 0;
        $or = 0;
        foreach (str_split($string) as $char) {
            $or |= (ord($char) << $shift);
            $shift += 8;
            $add += 8;
            while ($add >= 5) {
                $base32 .= $base32chars[$or & 31];
                $or >>= 5;
                $add -= 5;
            }
        }
        if ($add > 0) {
            $base32 .= $base32chars[($or << (5 - $add)) & 31];
        }
        return $base32;
    }

    private function generateQRCodeUrl($issuer, $email, $secret)
    {
        $url = sprintf(
            'otpauth://totp/%s:%s?secret=%s&issuer=%s',
            rawurlencode($issuer),
            rawurlencode($email),
            $secret,
            rawurlencode($issuer)
        );

        $renderer = new ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new ImageWriter()
        );

        $generator = new \BaconQrCode\Generator\Generator($renderer);
        $qrCode = $generator->generate($url, new QrCode(), new ErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM));

        ob_start();
        imagepng($qrCode->toImage());
        $qrCodeImage = ob_get_contents();
        ob_end_clean();

        return 'data:image/png;base64,' . base64_encode($qrCodeImage);
    }
}
