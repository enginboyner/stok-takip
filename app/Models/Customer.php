<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'phone', 'address', 'mail', 'status'];


    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

}
