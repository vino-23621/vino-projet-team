<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'size',
        'vintage',
        'identity_id',
        'country_id'
    ];
}
