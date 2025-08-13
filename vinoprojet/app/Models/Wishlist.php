<?php

namespace App\Models;

use App\Models\Bottle;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'users_id',
        'bottles_id',
        'quantity',
    ];

    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
