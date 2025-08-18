<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image',
        'price',
        'size',
        'vintage',
        'identity_id',
        'country_id',
        'grape_variety',
        'appellation',
        'alcohol_percentage',
        'sugar'
    ];

    protected $casts = [
        'grape_variety' => 'array',
        'alcohol_percentage' => 'float',
        'sugar' => 'float',
    ];

    /**
     * A bottle can be present in several cellars.
     */
    public function cellars()
    {
        return $this->belongsToMany(Cellar::class, 'cellar__has__bottles', 'bottle_id', 'cellar_id')
            ->withPivot('quantity');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Bottle::class);
    }


    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'bottles_has_comments')
            ->withPivot('comment')
            ->withTimestamps();
    }
}
