<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Users extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table='user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'role'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function billing_address(){
        return $this->hasOne('App\Models\BillingAddress', 'user_id');
    }
    public function shipping_address(){
        return $this->hasOne('App\Models\ShippingAddress', 'user_id');
    }
}
