<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name','url'];

    public function destinations() {
        return $this->belongsToMany(Destination::class,'destination_agency');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
