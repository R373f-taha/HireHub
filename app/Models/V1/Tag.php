<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
        protected $guarded = [];
   public function projects(){

   return $this->belongsToMany(Project::class);
   }

 public function attachments(){

        return $this->morphMany(Attachment::class,'attachable');
    }

}
