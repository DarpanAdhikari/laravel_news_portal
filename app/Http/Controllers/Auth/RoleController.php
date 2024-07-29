<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('permission:delete role|manage role',['only'=>['index']]);
      $this->middleware('permission:delete role',['only'=>['destroy']]);
      $this->middleware('permission:manage role',['only'=>['create','store','edit','update','providePermission','addPermissionToRole']]);
    }
    public function index(){
        $roles = Role::get();
        return view('role-permission.role.index',['roles'=>$roles]);
    }
//  create new role
    public function create(){
     return view('role-permission.role.create');
    }
 
    public function store(Request $request){
     $request->validate([
           'name'=> ['required', 'string', 'unique:roles'],
           'description'=> ['required', 'min:10', 'max:500'],
     ]);
     Role::create([
         'name' => $request->name,
         'description'=>$request->description,
     ]);
     return redirect('roles')->with([
         'type' => 'success',
         'title'=> 'Alert From '.config('app.name'),
         'message'=> 'New role created successfully',
     ]);
    }
 
    //  update role 
    public function edit(Role $role){
     return view('role-permission.role.edit',[
         'role'=>$role,
     ]);
    }
    public function update(Request $request, Role $role){
     $request->validate([
           'name'=> ['required', 'string', 'unique:roles,name,'.$role->id],
           'description'=> ['required', 'min:10', 'max:500'],
     ]);
     $role->update([
         'name'=>$request->name,
         'description'=>$request->description,
     ]);
     return redirect('roles')->with([
         'type' => 'success',
         'title'=> 'Alert From '.config('app.name'),
         'message'=> 'New role created successfully',
     ]);
    }
    // delete role
    public function destroy(Request $request, Role $role){
     $role->delete();
     return redirect('roles')->with([
         'type' => 'success',
         'title'=> 'Alert From '.config('app.name'),
         'message'=>'"'.$role->name.'" role deleted successfully',
     ]);
    }
    // add permission to role
    public function addPermissionToRole($role){
       $permission = Permission::all();
       $roleData = Role::findOrFail($role);
       $roleHasPermission = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$role)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
       return view('role-permission.role.add-permission',[
        'roles'=>$roleData,
        'permissions'=>$permission,
        'RoleHasPermission'=>$roleHasPermission,
       ]);
    }
    
    public function providePermission(Request $request, $role){
        $request->validate([
           'permission'=> 'required',
      ]);
      $roleCheck = Role::findOrFail($role);
      $roleCheck->syncPermissions($request->permission);
      return redirect('roles')->with([
        'type' => 'success',
        'title'=> 'Alert From '.config('app.name'),
        'message'=>'"'.$roleCheck->name.'" got new permissions',
    ]);
    }
}
