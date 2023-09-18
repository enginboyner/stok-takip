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
        return view('category.index', ["category" => $categories]);

    }

    public function add()
    {

        return view('category.add');

    }

    public function edit($CategoryID)
    {
        $categoryEdit = Category::find($CategoryID);
        return view('category.edit', ["categoryEdit" => $categoryEdit]);
    }

    public function delete($id)
    {
        $categoryDelete = Category::find($id);
        $categoryDelete->status = false;
        $categoryDelete->update();

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:categories,name',
        ], [], ["name" => "İsim"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->update();

        return $this->responseMessage("İşlem Başarılı", "success", 200, "/category");


    }

    public function show($CategoryID)
    {
        $category = Category::find($CategoryID);
        $product = Product::with("category")->where('category_id', $CategoryID)->get();


        return view('category.show', ["category" => $category, "product" => $product]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:categories,name',
        ], [], ["name" => "İsim"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $category = new Category();
        $category->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('category.add'));

    }

}
