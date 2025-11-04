<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'subtotal',
        'shipping_fee',
        'bank_discount',
        'other_discount',
        'total',
        'status',
        'address',
        'province',
        'district',
        'note',
        'payment_method',
        'code',
        'coupon_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
