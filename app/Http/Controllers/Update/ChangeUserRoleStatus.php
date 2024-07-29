<?php

namespace App\Http\Controllers\Update;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ChangeUserRoleStatus extends Controller
{
    // role change
    public function edit(User $role){
        $roles = Role::all();
        $userRole = $role->roles->pluck('name','name')->all();
        return view('role-permission.user.role',[
            'roles'=>$roles,
            'user'=>$role,
            'userRole'=> $userRole,
        ]);
    }

    public function changeRole(Request $request)
    {
        $request->validate([
            'user'=>['required','int'],
      ],
      [
        'user'=>'I think you are trying wrong way',
      ]);
        $user = User::where('id', $request->user)->first();
        if ($user) {
            $user->syncRoles($request->role);
            return redirect()->route('user.table')->with([
                'type' => 'success',
                'title'=> 'Alert From '.config('app.name'),
                'message'=> $user->name.' Role has been updated',
            ]);
        } else {
            abort(404);
        }
    }

    // block or unblock user
    public function statusUpdate($user, $status)
    {
        $user = User::where('email', $user)->first();
        if ($status === 'ban') {
            $status = 0;
        } else {
            $status = 1;
        }
            $user->update([
                'status' => $status,
            ]);
            return redirect()->back();
    }
}
