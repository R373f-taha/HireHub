<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
 use HasFactory;
     protected $guarded = [];
public function user(){
    return $this->belongsTo(User::class);
}

public function projects(){
    return $this->hasMany(Project::class);
}
    public function reviews(){
        return $this->hasMany(Review::class);
    }

}
