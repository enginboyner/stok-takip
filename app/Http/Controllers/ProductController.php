<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $category = Category::pluck('name', 'id')->toArray();

        return view('product.index', ["products" => $products, "category" => $category]);
    }

    public function add()
    {
        $categories = Category::all();

        return view("product.add", ["categories" => $categories]);
    }

    public function edit($ProductID)
    {
        $categories = Category::all();
        $productEdit = Product::find($ProductID);
        return view('product.edit', ["categories" => $categories, "productEdit" => $productEdit]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg',

        ], [
        ], ["name" => "İsim", "category_id" => "Kategori", "description" => "Açıklama", "image" => "Görsel"]);


        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }


        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->image = $data['image'] ?? $product->image;
        $product->update();

        return $this->responseMessage("İşlem Başarılı", "success", 200, '/product');


    }

    public function delete($id)
    {
        $productDelete = Product::find($id);
        $productDelete->status = false;
        $productDelete->update();

    }

    public function show($ProductID)
    {
        $product = Product::with("sales", "stock")->find($ProductID);
        return view('product.show', ["product" => $product]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'category_id' => 'required|gt:0|int',
            'description' => 'required|max:255|string',
            'image' => 'required|image|mimes:jpg,png,jpeg',

        ], [
        ], ["name" => "İsim", "category_id" => "Kategori", "description" => "Açıklama", "image" => "Görsel"]);

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
