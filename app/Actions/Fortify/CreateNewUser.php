<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'user',
            'otp' => $otp,
            'is_verified' => false,
        ]);

        // Send OTP email
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
                            </div>
                            <div style='background: #1e3a5f; padding: 10px; text-align: center;'>
                                <p style='color: #a0c4e8; margin: 0;'>© 2025 TaskFlow. All rights reserved.</p>
                            </div>
                        </div>
                    ");
        });

        return $user;
    }
}