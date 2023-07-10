<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('home.index', ["userAuth" => $userAuth,"roleAuth"=>$roleAuth]);

    }
}
//{{ $role->id }}">{{ $role->name }}
