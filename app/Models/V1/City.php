<?php

namespace App\Models\V1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
 protected $guarded = [];
   public function user(){
    return $this->hasOne(User::class);
   }

   public function County(){
    return $this->belongsTo(Country::class);
   }
}
