<?php

namespace App\Models\V1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
        protected $guarded = ['offer_status'];

 public function attachments(){

        return $this->morphMany(Attachment::class,'attachable');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function freelancer(){
        return $this->belongsTo(Freelancer::class);
    }

public function profileForAcceptedOffer()
{

    return Offer::with(['freelancer','freelancer.profile'])->get();

}
}
