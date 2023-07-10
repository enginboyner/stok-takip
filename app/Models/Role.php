<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "permission"

    ];

    protected $casts = [
        "permission" => "json",

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
