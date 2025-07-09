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

    /**
     * A bottle can be present in several cellars.
     */
    public function cellars()
    {
        return $this->belongsToMany(Cellar::class, 'cellar__has__bottles', 'bottle_id', 'cellar_id')
            ->withPivot('quantity');
    }
}
