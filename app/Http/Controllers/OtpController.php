<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function show()
    {
        if (Auth::user()->is_verified) {
            return redirect()->route('dashboard');
        }

        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $user = Auth::user();
        $enteredOtp = trim($request->otp);
        $storedOtp = (string) $user->otp;

        if ($storedOtp !== '' && hash_equals($storedOtp, $enteredOtp)) {
            $user->update([
                'is_verified' => true,
                'otp' => null,
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Account verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
    }

    public function resend()
    {
        $user = Auth::user();
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update(['otp' => $otp]);

        Mail::send([], [], function($message) use ($user, $otp) {
            $message->to($user->email)
                    ->subject('TaskFlow - Your OTP Verification Code')
                    ->html("
                        <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;'>
                            <div style='background: #1e3a5f; padding: 20px; text-align: center;'>
                                <h1 style='color: white; margin: 0;'>TaskFlow</h1>
                            </div>
                            <div style='padding: 30px; background: #f9f9f9;'>
                                <h2 style='color: #1e3a5f;'>Verify Your Account</h2>
                                <p>Hello {$user->name},</p>
                                <p>Your OTP verification code is:</p>
                                <div style='background: #1e3a5f; color: white; font-size: 36px; font-weight: bold; text-align: center; padding: 20px; border-radius: 8px; letter-spacing: 10px;'>
                                    {$otp}
                                </div>
                                <p style='margin-top: 20px; color: #666;'>This code expires in 10 minutes.</p>
                                <p style='color: #666;'>If you did not register for TaskFlow, please ignore this email.</p>
                            </div>
                            <div style='background: #1e3a5f; padding: 10px; text-align: center;'>
                                <p style='color: #a0c4e8; margin: 0;'>© 2025 TaskFlow. All rights reserved.</p>
                            </div>
                        </div>
                    ");
        });

        return back()->with('success', 'OTP sent to ' . $user->email . '! Please check your inbox.');
    }
}
