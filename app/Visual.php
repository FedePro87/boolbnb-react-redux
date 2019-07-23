<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
    ];

    function apartment(){
        return $this->belongsTo(Apartment::class);
      }
}
