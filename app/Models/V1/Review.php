<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    use  HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function freelancer(){

    return $this->belongsTo(Freelancer::class);
    }

    public function project(){

        return $this->belongsTo(Project::class);
    }
}
