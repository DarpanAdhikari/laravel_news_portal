<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RedirectController extends Controller
{
    public function redirect(){
        $permissions = Permission::all();
        if (Auth::user()->hasAnyPermission($permissions)){
            return redirect()->intended('dashboard');
        }else{
            return redirect()->intended('/');
        }
       }
}
