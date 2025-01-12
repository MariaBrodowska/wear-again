<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function offers(){
        return $this->hasMany(Offer::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
//    public function messages(){
//        return $this->hasMany(Message::class);
//    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function sentMessages(){
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function hasFavorite($offer_id){
        return $this->favorites()->where('offer_id', $offer_id)->exists();
    }
    public function receivedMessages(){
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
