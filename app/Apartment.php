<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        
        'title',
        'description',
        'price',
        'number_of_rooms',
        'bathrooms',
        'bedrooms',
        'square_meters',
        'address',
        'lat',
        'lng',
        'image'

      ];

      function user(){
        return $this->belongsTo(User::class);
      }

      function services(){
        return $this->belongsToMany(Service::class);
      }

      function sponsorships(){
        return $this->belongsToMany(Sponsorship::class)->withPivot('created_at', 'updated_at');

      }

      function messages(){
        return $this->hasMany(Message::class);
      }

      function visuals(){
        return $this->hasMany(Visual::class);
      }
}
