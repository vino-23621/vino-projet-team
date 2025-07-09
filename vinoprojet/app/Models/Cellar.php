<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model representing a cellar belonging to a user,
 * containing several bottles with a given quantity.
 */
class Cellar extends Model
{
    use HasFactory;

    /**
     * Each Cellar belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A Cellar contains several bottles (many-to-many relationship).
     */
    public function bottles()
    {
        return $this->belongsToMany(Bottle::class, 'cellar__has__bottles', 'cellar_id', 'bottle_id')
            ->withPivot('quantity');
    }
    protected $fillable = [
        'name',
        'image',
        'user_id'
    ];
}
