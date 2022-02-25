<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function getMainAddress()
    {
        return $this->addresses()->where('main', 1)->first();
        
    }
    public function isAdmin ()
    {
        
        return $this->roles->pluck('name')->contains('Admin');//не работает env('ADMIN_ROLE')
     //   return $this->roles->pluck('name')->contains(env('ADMIN_ROLE'));
    }
    public function roles ()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
     public function hasOrder ()
    {
          $hasOrder = Order::where('user_id', $this->id)->count();
        return $hasOrder; 
     
     }
}
