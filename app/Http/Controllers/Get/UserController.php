<?php

namespace App\Http\Controllers\Get;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
  public function getUsers()
  {
    $roles = Role::pluck('name','name')->all();
    $users =  User::orderBy('name', 'asc')
    ->paginate(6);
    return view('dashboard.userTable', ['users' => $users, 'roles'=>$roles]);
  }
  public function ourTeams()
  {
      $users = User::all();
      foreach ($users as $user) {
          $permissionsCount = 0;
          $roles = $user->getRoleNames();
          foreach ($roles as $roleName) {
              $role = Role::where('name', $roleName)->first();
              $permissionsCount += $role->permissions()->count();
          }
          $user->permissions_count = $permissionsCount;
      }
      $users = $users->sortByDesc('permissions_count');
  
      return view('pages.our_team', ['users' => $users]);
  }

}
