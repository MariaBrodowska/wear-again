<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['seller_id','name','description','size_id','category_id','price','condition','image_path','status'];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    public function getFavoritesCount(){
        return $this->favorites()->count();
    }
}
