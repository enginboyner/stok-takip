<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $role = Role::pluck('name', 'id')->toArray();
        return view('user.index', ["users" => $users, "userAuth" => $userAuth,"roleAuth"=>$roleAuth,"role"=>$role]);
    }

    public function add()
    {
        $roles = Role::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view("user.add", ["roles" => $roles, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }
    public function edit($userID)
    {
        $roles = Role::all();
        $userEdit = User::find($userID);
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('user.edit',["roles" => $roles,"userEdit"=>$userEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'mail' => 'required|email|unique:users,mail',
            'password' => 'required|string|min:6|max:30',
            'role_id' => 'required|gt:0|int',
            'status' => 'required|bool',

        ], [
        ], ["name" => "İsim", "mail" => "Mail", "password" => "Şifre", "role_id" => "Rol", "status" => "Durum"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = new User();
        $user->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('user.add'));
    }
}
