<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'date','status'];


    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id", "id");
    }
    public function total()
    {
        return $this->hasOne(SaleItem::class)
            ->select('sale_id', DB::raw('SUM(quantity*price) as total'))
            ->groupBy('sale_id');
    }


}
