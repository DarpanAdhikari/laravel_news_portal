<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            [
                'name' => 'change role',
                'description'=>'This user can change roles of any users',
            ],
            [
                'name' => 'delete role',
                'description'=>'Authorize to delete roles',
            ],
            [
                'name' => 'manage role',
                'description'=>'authorize to create,store,edit,update,providePermission role',
            ],
            [
                'name' => 'block/unblock',
                'description'=>'this permission authorize to ban or unban any user',
            ],
            [
                'name' => 'change on page',
                'description'=>'This authority change any content of page like navigation, translation',
            ],
            [
                'name' => 'view page content',
                'description'=>'this authorized to view page content but allow changes',
            ],
            [
                'name' => 'add post',
                'description'=>'this authorize to add new post',
            ],
            [
                'name' => 'update post',
                'description'=>'this authorize to update post',
            ],
            [
                'name' => 'delete post',
                'description'=>'this authorize to delete post',
            ],
            [
                'name' => 'view post',
                'description'=>'This authorized view uploaded post',
            ],
            [
                'name' => 'add ads',
                'description'=>'this authorize to add ads',
            ],
            [
                'name' => 'changes on ads',
                'description'=>'this authorize to make any changes like delete/update ads',
            ],
            [
                'name' => 'permission management',
                'description'=>'this authorize to manage permission of user role',
            ],
            [
                'name' => 'view users',
                'description'=>'This authorizes to view how many users are there',
            ],
            [
                'name' => 'change css code',
                'description'=>'this is authority of changing css of our website',
            ],
        ]);

        $permissions->each(function($permission){
          Permission::create($permission);
        });
    }
}
