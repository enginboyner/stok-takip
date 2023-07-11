<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        $product = Product::pluck('name', 'id')->toArray();
        $customer = Customer::pluck('name', 'id')->toArray();
        $userID = User::pluck('name', 'id')->toArray();
        return view('sales.index', ["sales" => $sales, "userAuth" => $userAuth,"roleAuth"=>$roleAuth,"product"=>$product,'customer'=>$customer,'userID'=>$userID]);

    }

    public function add()
    {

        $products = Product::all();
        $users = User::all();
        $customers = Customer::all();
        $userAuth = auth()->user();
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view("sales.add", ["products" => $products, "users" => $users, "customers" => $customers, "userAuth" => $userAuth,"roleAuth"=>$roleAuth]);

    }
    public function edit($SalesID)
    {
        $products = Product::all();
        $users = User::all();
        $customers = Customer::all();
        $userAuth = auth()->user();
        $salesEdit = Sale::find($SalesID);
        $roleAuth = Role::find($userAuth->role_id)->name;
        return view('sales.edit',["products" => $products,"salesEdit"=>$salesEdit,"userAuth" => $userAuth,"roleAuth"=>$roleAuth,"users" => $users, "customers"=>$customers]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'product_id' => 'required|gt:0|int',
            'user_id' => 'required|gt:0|int',
            'customer_id' => 'required|gt:0|int',
            'date' => 'required|date',
            'price' => 'required|gt:0|numeric|gt:0',
            'quantity' => 'required|int|gt:0',
            'status' => 'required|bool',
        ], [
        ], ["product_id" => "Ürün", "user_id" => "Satıcı", "customer_id" => "Müşteri", "date" => "Tarih", "quantity" => "Miktar","price"=>"Fiyat"]);

        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }          // return redirect('/add')->withErrors($validator)->withInput();

        $data = $request->all();

        $sale = new Sale();
        $sale->fill($data)->save();


        return $this->responseMessage("Başarılı.", "success", 200, route('sales.add'));

    }
}
