<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellar_Has_Bottle extends Model
{
    use HasFactory;



    protected $table = 'cellar__has__bottles';

    protected $fillable = [
        'cellar_id',
        'bottle_id',
        'quantity',
    ];

    public function cellar()
    {
        return $this->belongsTo(Cellar::class);
    }

    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }
}
