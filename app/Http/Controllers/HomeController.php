<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Assign Role to User
            // $role = Role::where('slug','author')->first();
            // $user->roles()->attach($role);

        //Checking Role of the User
            // dd($user->hasRole('author'));
        
        //Assigning and Checking Permissions
        // $permission = Permission::first();

        // $user->permissions()->attach($permission);

        dd($user->can('add-post'));
        // dd($user->permissions);
        return view('dashboard');
    }
}
