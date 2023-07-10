<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forget()
    {

        return view("auth.forget");

    }

    public function loginControl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail' => 'required|email',
            'password' => 'required|min:6|max:30',
        ], [], ["mail" => "Mail", "password" => "Şifre"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        if (Auth::attempt(["mail" => $request->mail, "password" => $request->password])) {
            if (Auth::check()) {
                $user = Auth::user();
                $role_id = $user->role_id;

                if ($role_id == 1) {
                    return $this->responseMessage("Giriş başarılı.", "success", 200, route('home'));
                } elseif ($role_id == 2) {
                    return $this->responseMessage("Giriş başarılı.", "success", 200, route('home'));
                } elseif ($role_id == 3) {
                    return $this->responseMessage("Giriş başarılı.", "success", 200, route('home'));
                }
            }
        }

        return $this->responseMessage("Kullanıcı adı veya şifre hatalı.", "error", 400);
    }

}

