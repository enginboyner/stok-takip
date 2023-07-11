<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('category.index', ["category" => $categories, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }

    public function add()
    {
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('category.add', ["userAuth" => $userAuth,"roleAuth"=>$roleAuth]);

    }
    public function edit($CategoryID)
    {
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $categoryEdit = Category::find($CategoryID);
        return view('category.edit',["categoryEdit"=>$categoryEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }


    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:categories,name',
            'status' => 'required|bool',
        ], [], ["name" => "İsim","status"=>"Durum"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $category = new Category();
        $category->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('category.add'));
;
    }
}
