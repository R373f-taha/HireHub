<?php
namespace App\Models\V1;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

       protected function casts(): array
    {
        return [
             'deadline'=>'date',
           //  'budget'=>'array'

        ];
    }
     public function attachments(){

        return $this->morphMany(Attachment::class,'attachable');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function tags(){

    return $this->belongsToMany(Tag::class);
    }

    public function offers(){
        return $this->hasMany(Offer::class);}
    protected function budget():Attribute{
       return Attribute::make(

       get:function($value,$attributes){

            if (is_string($value)) {
             $value = json_decode($value, true);
            }

            if (is_string($value)) {
              $value = json_decode($value, true);
            }

            if (!is_array($value)) {
                return null;
            }
         //  $budgetData=json_decode($value,true);
          return  match($attributes['type_of_balance']){

           'fixed' => number_format($value['amount'],2) . ' USD'?? 'USD',
           'hourly'=>number_format($value['rate'],2).' $/hr' ?? '$/hr',
           default => throw new Exception('Unknown budget type...')


            };
            }
        );
    }

  protected function deadlineDaysLeft(): Attribute{
        return Attribute::make(
            get:function($value,$attributes){
                if(empty($attributes['deadline']))
                    return null;
                $deadline=Carbon::parse($attributes['deadline']);
                return now()->diffInDays($deadline,false);

            }
        );
    }

    public function  scopeWithStatus($query,string $status){//for open projects
        return $query->where('project_status',$status);
    }

    public function  scopeProjectsAboveCertainAmount($query,$amount){
        $query->where('JSON_EXTRACT(budget,"$.max")','>',$amount);//it works on the DB before fetching the data so we extract  json
    }

    public function scopeProjectsForThisMonth($query){
      $startOfMonth=Carbon::now()->startOfMonth();
      $endOfMonth=Carbon::now()->endOfMonth();
      return $query->whereBetween('created_at',[$startOfMonth,$endOfMonth]);


    }
        public function reviews(){
        return $this->hasOne(Review::class);
    }

    public function canBeReviewed(){
        return $this->project_status==='closed';
    }

}
