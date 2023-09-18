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
        $product = Product::pluck('name', 'id')->toArray();
        return view('stock.index', ["stocks" => $stocks, "product" => $product]);
    }

    public function add()
    {
        $products = Product::all();
        return view("stock.add", ["products" => $products]);
    }

    public function edit($StockID)
    {
        $products = Product::all();
        $stockEdit = Stock::find($StockID);
        return view('stock.edit', ["products" => $products, "stockEdit" => $stockEdit]);
    }

    public function delete($id)
    {
        $stockDelete = Stock::find($id);
        $stockDelete->status = false;
        $stockDelete->update();

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|gt:0|int',
            'quantity' => 'required|int|gt:0',
            'price' => 'required|gt:0|numeric',
        ], [
        ], ["product_id" => "Ürün", "quantity" => "Miktar", "price" => "Fiyat"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $stock = Stock::find($id);
        $stock->product_id = $request->input('product_id');
        $stock->quantity = $request->input('quantity');
        $stock->price = $request->input('price');
        $stock->update();

        return $this->responseMessage("İşlem Başarılı", "success", 200, '/stock');


    }

    public function show($StockID)
    {
        $stock = Stock::with("product")->find($StockID);

        return view('stock.show', ["stock" => $stock]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|gt:0|int',
            'quantity' => 'required|int|gt:0',
            'price' => 'required|gt:0|numeric',
        ], [
        ], ["product_id" => "Ürün", "quantity" => "Miktar", "price" => "Fiyat"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();


        $stock = new Stock();
        $stock->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('stock.add'));
    }
}
