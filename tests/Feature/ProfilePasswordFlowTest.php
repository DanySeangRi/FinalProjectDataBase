<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('rejects an incorrect current password for profile password updates', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $this->actingAs($user);

    $response = $this->put('/user/profile/password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password-123',
        'password_confirmation' => 'new-password-123',
    ]);

    $response->assertSessionHasErrors('current_password');
});
