<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{

    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'price_id',
        'city',
        'name',
    ];
}
