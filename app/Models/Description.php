<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'resturant_id',
    ];

    public function description()
    {
        return $this->hasMany(Resturant::class);
    }
}
