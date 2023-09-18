<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index()
    {

        $sales = Sale::with("customer", "total")
            ->get();


        return view('sales.index', ["sales" => $sales]);

    }

    public function add()
    {

        $customers = Customer::all();
        $products = Product::all();
        return view("sales.add", ["products" => $products, "customers" => $customers]);


    }

    public function edit($SalesID)
    {

        $products = Product::all();
        $customers = Customer::all();
        $salesEdit = Sale::find($SalesID);
        $salesItem = SaleItem::where('sale_id', $SalesID)->get();
        return view('sales.edit', ["products" => $products, "salesEdit" => $salesEdit, "customers" => $customers, "salesItem" => $salesItem]);
    }

    public function delete($id)
    {
        $saleDelete = Sale::find($id);
        $saleDelete->status = false;
        $saleDelete->update();

    }

    public function show($SalesID)
    {
        $sale = Sale::with("items.product", "customer")->find($SalesID);

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

        $data = $request->all();

        // Check if the sale record exists
        $sales = Sale::find($id);
        if (!$sales) {
            return $this->responseMessage("Satış kaydı bulunamadı.", "error", 404);
        }

        // Update the sales record
        $sales->customer_id = $data['customer_id'];
        $sales->date = $data['date'];
        $sales->save();

        // Delete the existing sale items associated with the sale
        SaleItem::where('sale_id', $id)->delete();

        // Create new sale items for the updated sale
        foreach ($data["product_id"] as $key => $product) {
            $item = new SaleItem();
            $item->sale_id = $id;
            $item->product_id = $product;
            $item->quantity = $data["quantity"][$key];
            $item->price = $data["price"][$key];
            // Diğer gerekli ürün kalemi bilgilerini burada atayın
            $item->save();
        }

        return $this->responseMessage("Satış başarıyla güncellendi.", "success", 200, route('sales.edit', $id));
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
            return $this->responseMessage(implode(' ', $validator->errors()->all()), "error", 400);
        }

        $data = $request->all();

        //her ürün için istenilen adet var mı diye kontrol et
        foreach ($data["product_id"] as $key => $product) {

            /*
        foreach ($data["product_id"] as $key => $product){
        $stock=Stock::select(DB::raw("sum(quantity) as stock"))->where("product_id",$product)->first();
        $sale=SaleItem::select(DB::raw("sum(quantity) as sale"))->where("product_id",$product)->first();
        $productData=Product::find($product);

        if(($stock->stock - $sale->sale - $data["quantity"][$key]) <=0)
        {
        return $this->responseMessage($productData->name ." yeterli sayıda bulunmuyor.","error",200);
        }


            */

            $productWithTotalSalesCount = Product::withCount(["sales" => function ($salesCount) {
                $salesCount->select(DB::raw('SUM(quantity)'));
            }])->find($product);
            $productWithTotalStockCount = Product::withCount(["stock" => function ($stockCount) {
                $stockCount->select(DB::raw('SUM(quantity)'));
            }])->find($product);

//            $amountProductsStock = Product::withCount(["productStock", "productSale"])->find($product)->productStock;
//            $amountProductsSale = Product::withCount(["productStock", "productSale"])->find($product)->productSale;

            if (($productWithTotalStockCount->stock_count - $productWithTotalSalesCount->sales_count - $data["quantity"][$key]) <= 0) {
                return $this->responseMessage($product . " Yeterli stok bulunmuyor.", "error", 200);
            }

        }


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

    public function getSaleItems($saleID)
    {

        $saleItems = SaleItem::with("product")->where('sale_id', $saleID)->get();

        return response()->json($saleItems);
    }
}
