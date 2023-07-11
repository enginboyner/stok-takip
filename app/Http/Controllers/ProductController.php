<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $category = Category::pluck('name', 'id')->toArray();
        return view('product.index', ["products" => $products, "userAuth" => $userAuth,"roleAuth"=>$roleAuth,"category"=>$category]);
    }

    public function add()
    {
        $categories = Category::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view("product.add", ["categories" => $categories, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }
    public function edit($ProductID)
    {
        $categories = Category::all();
        $userAuth = auth()->user();
        $productEdit = Product::find($ProductID);
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('product.edit',["categories" => $categories,"productEdit"=>$productEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->save();
    }
    public function delete($id)
    {
        Product::find($id)->delete();
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'category_id' => 'required|gt:0|int',
            'description' => 'required|max:255|string',
            'status' => 'required|bool',
            'image' => 'required|image|max:10000|mimes:jpg,png,jpeg',

        ], [
        ], ["name" => "İsim", "category_id" => "Kategori", "description" => "Açıklama", "status" => "Durum", "image" => "Görsel"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $product = new Product();
        $product->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('product.add'));



    }
}


?>
