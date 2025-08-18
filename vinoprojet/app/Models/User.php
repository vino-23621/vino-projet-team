<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * A user can have multiple cellars.
     */
    public function cellars()
    {
        return $this->hasMany(Cellar::class);
    }

    public function defaultCellar()
    {
        return $this->belongsTo(Cellar::class, 'cellar_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Bottle::class, 'wishlist', 'users_id', 'bottles_id')->withPivot('quantity');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cellar_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getActiveCellar()
    {
        $cellarId = session('active_cellar_id') ?? $this->cellar_id;
        return $cellarId ? \App\Models\Cellar::find($cellarId) : null;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
