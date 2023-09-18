<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'status', 'category_id', 'image'];


    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function sales()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function sale()
    {
        return $this->hasOne(SaleItem::class)
            ->select('product_id', DB::raw('SUM(quantity*price) as totalSale'))
            ->groupBy('product_id');
    }

    public function purchase()
    {
        return $this->hasOne(Stock::class)
            ->select('product_id', DB::raw('SUM(quantity*price) as totalPurchase'))
            ->groupBy('product_id');
    }

    public function squantity()
    {
        return $this->hasOne(SaleItem::class)
            ->select('product_id', DB::raw('SUM(quantity) as stotal'))
            ->groupBy('product_id');
    }

    public function pquantity()
    {
        return $this->hasOne(Stock::class)
            ->select('product_id', DB::raw('SUM(quantity) as ptotal'))
            ->groupBy('product_id');
    }

    /* public function productStock()
     {
         return $this->hasOne(Stock::class)
             ->select(DB::raw("SUM(quantity) as stock"),"product_id")
             ->groupBy('product_id');
     }


     public function productSale()
     {
         return $this->hasOne(SaleItem::class)
             ->select(DB::raw("SUM(quantity) as sale"),"product_id")
             ->groupBy('product_id');
     }

   */

}
