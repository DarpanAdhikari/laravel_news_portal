<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewUserNotification;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        $totalUser =  User::count();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $userId = $this->generateUniqueUserId($input['name']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'u_id' => $userId,
        ]);

        return $user;
    }
    private function generateUniqueUserId($name)
    {
        $cleanName = preg_replace('/[^a-zA-Z0-9]+/', '', $name);
        $userId = Str::slug($cleanName);
        $baseUserId = $userId;
        $counter = 1;
        while (User::where('u_id', $userId)->exists()) {
            $randomString = Str::random(6);
            $userId = $baseUserId . '-' . $randomString;
            $counter++;
        }

        return $userId;
    }
}
