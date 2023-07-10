<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'status', 'category_id', 'image'];


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    use HasFactory;
}
