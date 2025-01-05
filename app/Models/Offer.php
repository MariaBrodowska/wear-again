<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['user_id','name','description','size_id','category_id','price','condition','image_path','status'];
    use HasFactory;
}
