<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['buyer_id','delivery_method_id','payment_method_id','payment_status','offer_id','total_price','order_status'];
    use HasFactory;
    public function delivery_method(){
        return $this->belongsTo(Delivery_Method::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function payment_method(){
        return $this->belongsTo(Payment_Method::class);
    }
    public function offers(){
        return $this->hasMany(Offer::class);
    }
}
