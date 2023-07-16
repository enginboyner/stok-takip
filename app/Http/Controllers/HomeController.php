<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
//{{ $role->id }}">{{ $role->name }}
