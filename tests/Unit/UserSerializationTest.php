<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserSerializationTest extends TestCase
{
    public function test_sensitive_authentication_attributes_are_hidden_from_serialized_user_data(): void
    {
        $user = new User;
        $user->setRawAttributes([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret-password',
            'remember_token' => 'remember-token',
            'two_factor_secret' => 'two-factor-secret',
            'two_factor_recovery_codes' => 'recovery-codes',
        ]);

        $serializedUser = $user->toArray();

        $this->assertArrayNotHasKey('password', $serializedUser);
        $this->assertArrayNotHasKey('remember_token', $serializedUser);
        $this->assertArrayNotHasKey('two_factor_secret', $serializedUser);
        $this->assertArrayNotHasKey('two_factor_recovery_codes', $serializedUser);
    }
}
