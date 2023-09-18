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
        $roles = Role::pluck('name', 'id')->toArray();
        return view('user.index', ["users" => $users, "roles" => $roles]);
    }

    public function add()
    {
        $roles = Role::all();
        return view("user.add", ["roles" => $roles]);
    }

    public function edit($userID)
    {
        $roles = Role::all();
        $userEdit = User::find($userID);
        return view('user.edit', ["roles" => $roles, "userEdit" => $userEdit]);
    }

    public function delete($id)
    {
        $userDelete = User::find($id);
        $userDelete->status = false;
        $userDelete->update();

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'mail' => 'required|email|unique:users,mail',
            'password' => 'required|string|min:6|max:30',
            'role_id' => 'required|gt:0|int',
        ], [
        ], ["name" => "İsim", "mail" => "Mail", "password" => "Şifre", "role_id" => "Rol"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->mail = $request->input('mail');
        $user->role_id = $request->input('role_id');
        $user->update();


        return $this->responseMessage("İşlem Başarılı", "success", 200, '/user');


    }

    public function show($UserID)
    {
        $user = User::with("role")->find($UserID);

        return view('user.show', ["user" => $user]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'mail' => 'required|email|unique:users,mail',
            'password' => 'required|string|min:6|max:30',
            'role_id' => 'required|gt:0|int',
        ], [
        ], ["name" => "İsim", "mail" => "Mail", "password" => "Şifre", "role_id" => "Rol"]);

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
