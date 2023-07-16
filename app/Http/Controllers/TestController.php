<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(){




            $product=Product::with('category')->where('category_id',88)->get();
dd($product[1]->name);

        /* $product=Product::find(57);

         $productWithCategory=Product::with("category")->find(57);

         $productWithSales=Product::with("sales")->find(57);

         $productWithSalesCount=Product::withCount("sales")->find(57);

         $productWithTotalSalesCount=Product::withCount(["sales"=>function ($engin){
             $engin->select( DB::raw('SUM(quantity)'))
                ;
         }])->find(57);
         $productWithTotalStockCount=Product::withCount(["stock"=>function ($stockCount){
             $stockCount->select( DB::raw('SUM(quantity)'))
             ;
         }])->find(57);
         dd($productWithTotalStockCount->stock_count);
         $productWithTotalSalesAmount=Product::withCount(["sales"=>function ($engin){
             $engin->select( DB::raw('SUM(quantity*price)'))
             ;
         }])->find(57);

         $productWithSales=Product::with(["sales.sale"=>function($q){
             $q->where("status",1);
         }])->find(57);
 */

       /* $productWithActiveSales=Product::whereHas("sales.sale",function($q){
            $q->where("status",1);
        })->find(57);*/



        /*
        return json_encode([
            "urun" =>$product,
            "urun_kategori_ile_birlikte" =>$productWithCategory,
            "urun_satis_listesi" =>$productWithSales,
            "urun_satis_sayisi" => $productWithSalesCount,
            "urun_satis_sayisi_toplam" =>$productWithTotalSalesCount,
            "urun_toplam_satis_miktari" =>$productWithTotalSalesAmount,
            "urun_satislari_satis_bilgisi_ile_birlikte" =>$productWithSales,
            //"urun_satislari_aktif_olanlar" =>$productWithActiveSales
        ]);
        */
    }

}
