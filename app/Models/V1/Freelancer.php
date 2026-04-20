<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

 protected $guarded = [];


    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',

        ];
    }

 public function user(){
    return $this->belongsTo(User::class);
}

public function profile(){
    return $this->hasOne(Profile::class);
}

public function skills(){
    return $this->belongsToMany(Skill::class);
}

    public function attachments(){

        return $this->morphMany(Attachment::class,'attachable');
    }

    public function offers(){
        return $this->hasMany(Offer::class);
    }

    public function scopeActiveAndVerified($query){
        return $query->where('is_active',true)
                      ->where('is_verified',true);
    }

    public function scopeAvailableAndVerifiedFreelancer($query){

    return $query->where('is_verified',true)->where('is_active',true)->whereHas('profile',function($q){
              $q->where('available_mode','available');
    });
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
        public function averageRating(){
        return $this->reviews()->avg('freelancer_rating');
    }

    public function scopeOrderByReviews($query){

       $query->withAvg('reviews','freelancer_rating')->orderBy('reviews_avg_freelancer_rating','DESC');

    }
}
