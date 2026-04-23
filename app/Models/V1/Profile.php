<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

        protected $guarded = [];


    protected function casts(): array
    {
        return [
            'hour_rate' => 'float',
           //  'skills_summary'=>'array',
             'portfolio_link'=>'array'

        ];
    }

   public function freelancer(){
    return $this->belongsTo(Freelancer::class);
   }


   protected function fullName():Attribute{
   return Attribute::make(
    get:fn($value,$attributes)=>$attributes['first_name'].' '.$attributes['last_name']

   );
   }


    protected function avatar():Attribute{
   return Attribute::make(
    get:fn()=>$this->image?asset('storage/'.$this->image):'https://ui-avatars.com/api/?name='.$this->fullName

   );
   }


    protected function joinDate():Attribute{
   return Attribute::make(
    get:fn()=>'Member since '.$this->created_at->month.' '.$this->created_at->year

   );
   }


    protected function phone(){
   return Attribute::make(
    get:fn($value)=>$value ?? '',
    set:function($value){
      $cleand=preg_replace('/[^0-9+]/','',$value);
    preg_replace('/(\+\d{3})(\d{2})(\d{4})(\d{3})/','$1 $2 $3 $4',$cleand) ;} //+962 79 1234 567

   );

   }

   protected  function skillsSummary():Attribute{
     return Attribute::make(

     set:fn($value)=>is_array($value) ?json_encode($value):$value,
     get:fn($value)=>is_null($value)?[]:(is_array($value)?$value:json_decode($value,true)?? [])

   );
   }


   protected  function portfolioLink():Attribute{
     return Attribute::make(

   set:fn($value)=>is_array($value) ?json_encode($value):$value,
     get:fn($value)=>is_null($value)?[]:(is_array($value)?$value:json_decode($value,true)?? [])

   );
   }
   public function scopeOnlyAvailable($query){

    return $query->where('available_mode','available');
   }

}
