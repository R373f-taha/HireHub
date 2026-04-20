<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Country extends Model
{
    use HasFactory;

        protected $guarded = [];
    public function cities(){
    return $this->hasMany(City::class);
   }

   public function users(){
    return $this->HasManyThrough(User::class,City::class,'country_id', 'city_id');
   }
}
