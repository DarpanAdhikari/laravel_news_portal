<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'tester',
            'description' => 'Tester is first user to test site',
        ]);
        $permissions = Permission::pluck('name','name')->all();
        $role->syncPermissions($permissions);
    }
}
