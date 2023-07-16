<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'status', 'category_id', 'image'];


    public function item()
    {
        return $this->hasOne(SaleItem::class);
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    use HasFactory;
}
