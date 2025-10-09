<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['user_id','name','description','country','fragment'];

    public function images() {
        return $this->hasMany(DestinationImage::class);
    }

    public function agencies() {
        return $this->belongsToMany(Agency::class,'destination_agency');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favoriteByUser() {
        return $this->belongsToMany(User::class,'favorite_destinations');
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function averageRating() {
        return $this->ratings()->avg('stars');
    }

}
