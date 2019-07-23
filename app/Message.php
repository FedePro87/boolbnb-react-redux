<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    'title',
    'content',
    'email'
    ];


    function apartment(){
        return $this->belongsTo(Apartment::class);
      }
}
