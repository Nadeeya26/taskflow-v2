<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtpVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unverified_user_is_redirected_to_otp_screen(): void
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'is_verified' => false,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('otp.show', absolute: false));
    }

    public function test_user_can_verify_with_valid_otp(): void
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'is_verified' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.verify'), [
            'otp' => '123456',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertTrue($user->fresh()->is_verified);
        $this->assertNull($user->fresh()->otp);
    }

    public function test_user_can_verify_with_pasted_otp_containing_spaces(): void
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'is_verified' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.verify'), [
            'otp' => '123 456',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertTrue($user->fresh()->is_verified);
    }

    public function test_user_can_resend_otp(): void
    {
        $user = User::factory()->create([
            'otp' => '123456',
            'is_verified' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.resend'));

        $response->assertSessionHas('success');
        $this->assertMatchesRegularExpression('/^\d{6}$/', $user->fresh()->otp);
    }
}
