<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'customer_id', 'date', 'price', 'quantity','status'];


    public function product()
    {
        return $this->hasOne(Product::class, "id", "product_id");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, "id", "customer_id");
    }
}
