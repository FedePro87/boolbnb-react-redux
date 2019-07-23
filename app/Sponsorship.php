<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'duration',
        'amount'
    ];

    function apartments(){
        return $this->belongsToMany(Apartment::class)->withPivot('created_at', 'updated_at');
      }
}
