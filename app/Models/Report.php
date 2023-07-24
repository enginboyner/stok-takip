<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
