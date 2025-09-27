<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'status'
    ];

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function withdrawRequests()
    {
        return $this->hasMany(WithdrawRequest::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function customerTokens()
    {
        return $this->hasMany(CustomerToken::class);
    }
}
