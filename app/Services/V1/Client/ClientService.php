<?php

namespace App\Services\V1\Client;

use App\Models\V1\Offer;
use App\Models\V1\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class ClientService{
/**
 * قبول عرض معين على مشروع
 *
 * عند قبول عرض، يتم:
 * 1. تحديث حالة المشروع إلى in_progress
 * 2. تحديث حالة العرض المقبول إلى accepted
 * 3. تحديث حالة جميع العروض الأخرى على نفس المشروع إلى rejected
 
 */
public function acceptOffer($project_id,$offer_id){

DB::beginTransaction();

try{
$offer=Offer::where('project_id',$project_id)->where('id',$offer_id)
->where('offer_status','pending')->first();
// var_dump($offer);
    if (!$offer) {
        return [
            'message' => 'Offer not found or already processed'
        ];
    }
$project=Project::findOrFail($project_id);

if($project->project_status !=='open')

    return ['message'=>'this project is '.$project->project_status .'  so it`s not oppen for offers🙄'  ];

$offer->update(['offer_status'=>'accepted']);

Offer::where('project_id',$project_id)->where('id','!=',$offer_id)
->where('offer_status','pending')
->update(['offer_status'=>'rejected']);

$project->update(['project_status'=>'in_progress']);

return [
    'message'=>'offer accepted successfully'

];
}
catch(Exception $e){
    DB::rollBack();
    return [
    'message'=>'offer accepted failed ... something is wrong '

];
}
}
}
