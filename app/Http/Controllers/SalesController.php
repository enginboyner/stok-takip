<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {

        $sales = Sale::with("customer")
            ->with(['items' => function ($query) {
                $query->select("sale_id", DB::raw("sum(quantity*price) as total"))
                    ->groupBy("sale_id");
            }])
            ->get();

        return view('sales.index', ["sales" => $sales]);

    }

    public function add()
    {
        $customers=Customer::all();
        $products = Product::all();
        return view("sales.add", ["products" => $products,"customers"=>$customers]);

    }
    public function edit($SalesID)
    {

        $products = Product::all();
        $customers = Customer::all();
        $salesEdit = Sale::find($SalesID);
        $salesItem=SaleItem::find($SalesID);
        return view('sales.edit',["products" => $products,"salesEdit"=>$salesEdit, "customers"=>$customers, "salesItem"=>$salesItem]);
    }

    public function delete($id)
    {
        $saleDelete= Sale::find($id);
        $saleDelete->status=false;
        $saleDelete->update();

    }
    public function show($SalesID)
    {
        $sale=Sale::with("items.product", "customer")->find($SalesID);

        return view('sales.show', ["sale" => $sale]);
    }
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|array',
            'price' => 'required|array',
            'quantity' => 'required|array',
            'customer_id' => 'required|gt:0|int',
            'date' => 'required|date',
        ], [], ["product_id" => "Ürün", "quantity" => "Miktar", "price" => "Fiyat", "customer_id" => "Müşteri", "date" => "Tarih"]);



        if ($validator->fails()) {
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }


        $sale = Sale::find($id);
        $sale->product_id = $request->input('product_id');
        $sale->quantity = $request->input('quantity');
        $sale->price = $request->input('price');
        $sale->update();

        return $this->responseMessage("İşlem Başarılı","success",200,'/sales');


    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'product_id' => 'required|array',
            'price' => 'required|array',
            'quantity' => 'required|array',
            'customer_id' => 'required|gt:0|int',
            'date' => 'required|date',
        ], [], ["product_id" => "Ürün", "quantity" => "Miktar", "price" => "Fiyat", "customer_id" => "Müşteri", "date" => "Tarih"]);



        if ($validator->fails()) {
            $errorMessages = [];
            foreach ($validator->errors()->keys() as $key) {
                $errorMessages[] = $validator->errors()->first($key);
            }

            return $this->responseMessage(implode(' ', $errorMessages[]), "error", 400);
        }

        $data = $request->all();

        //satışı kaydet
        $sales = new Sale();
        $sales->customer_id = $data['customer_id'];
        $sales->date = $data['date'];
        $sales->save();

        //example: $sales= satış kaydetme kodu

        $saleID = $sales->id;


        // kaydettiğin satışın, "id" bilgisini al
        //$salesId=$sales->id;



        //her bir satış kalemi için item kaydet tabloya
        // foreach($data["product_id"] as $product)
        //her bir ürün için item tablosuna kayıt at
        foreach ($data["product_id"] as $key => $product) {
            $item = new SaleItem();
            $item->sale_id = $saleID;
            $item->product_id = $product;
            $item->quantity = $data["quantity"][$key];
            $item->price = $data["price"][$key];
            // Diğer gerekli ürün kalemi bilgilerini burada atayın
            $item->save();
        }






        return $this->responseMessage("Başarılı.", "success", 200, route('sales.add'));

    }
}
