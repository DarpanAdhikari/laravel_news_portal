<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'u_id' => 'tester',
            'email' => 'tester@tester.com',
            'name' => 'tester',
            'password' => Hash::make('tester@@'),
        ]);
        $user->syncRoles('tester');
    }
}
