<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'price', 'status'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
