<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission management',['only'=>['index','create','store','edit','update','destroy']]);
    }
   public function index(){
       $permissions = Permission::get();
       return view('role-permission.permission.index',['permissions'=>$permissions]);
   }

   public function create(){
    return view('role-permission.permission.create');
   }

   public function store(Request $request){
    $request->validate([
          'name'=> ['required', 'string', 'unique:permissions'],
          'description'=> ['min:10', 'max:500'],
    ]);
    Permission::create([
        'name' => $request->name,
        'description'=>$request->description,
    ]);
    return redirect('permissions')->with([
        'type' => 'success',
        'title'=> 'Alert From '.config('app.name'),
        'message'=> 'New permission created successfully',
    ]);
   }

   public function edit(Permission $permission){
    return view('role-permission.permission.edit',[
        'permission'=>$permission,
    ]);
   }

   public function update(Request $request, Permission $permission){
    $request->validate([
        'name'=> ['required', 'string', 'unique:permissions,name,'.$permission->id],
        'description'=> ['min:10', 'max:500'],
    ]);
    $permission->update([
        'name'=>$request->name,
        'description'=>$request->description,
    ]);
    return redirect('permissions')->with([
        'type' => 'success',
        'title'=> 'Alert From '.config('app.name'),
        'message'=> 'New permission created successfully',
    ]);
   }
   public function destroy(Request $request, Permission $permission){
    $permission->delete();
    return redirect('permissions')->with([
        'type' => 'success',
        'title'=> 'Alert From '.config('app.name'),
        'message'=>'"'.$permission->name.'" permission deleted successfully',
    ]);
   }
}
