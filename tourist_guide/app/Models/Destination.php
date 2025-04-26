<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['name','description'];

    public function images() {
        return $this->hasMany(DestinationImage::class);
    }

    public function agencies() {
        return $this->belongsToMany(Agency::class,'destination_agency');
    }
}
