<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Role;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $product = Product::pluck('name', 'id')->toArray();
        return view('stock.index', ["stocks" => $stocks, "userAuth" => $userAuth,"roleAuth"=>$roleAuth,"product"=>$product]);
    }

    public function add()
    {
        $products = Product::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view("stock.add", ["products" => $products, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }
    public function edit($StockID)
    {
        $products = Product::all();
        $userAuth = auth()->user();
        $stockEdit = Stock::find($StockID);
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('stock.edit',["products" => $products,"stockEdit"=>$stockEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|gt:0|int',
            'quantity' => 'required|int|gt:0',
            'price' => 'required|gt:0|numeric',
            'status' => 'required|bool',
        ], [
        ], ["product_id" => "Ürün", "quantity" => "Miktar", "price" => "Fiyat", "status" => "Durum"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $stock = new Stock();
        $stock->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('stock.add'));
    }
}
