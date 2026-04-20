<?php

namespace App\Services\V1\Client;

use App\Models\V1\Offer;
use App\Models\V1\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class ClientService{

public function acceptOffer($project_id,$offer_id){

DB::beginTransaction();

try{
$offer=Offer::where('project_id',$project_id)->where('id',$offer_id)
->where('offer_status','pending')->first();
// var_dump($offer);
    if (!$offer) {
        return [
            'success' => false,
            'message' => 'Offer not found or already processed'
        ];
    }
$project=Project::findOrFail($project_id);

if($project->project_status !=='open')

    return ['success'=>false,'message'=>'this project is '.$project->project_status .'  so it`s not oppen for offers🙄'  ];

$offer->update(['offer_status'=>'accepted']);

Offer::where('project_id',$project_id)->where('id','!=',$offer_id)
->where('offer_status','pending')
->update(['offer_status'=>'rejected']);

$project->update(['project_status'=>'in_progress']);

return [
    'success'=>true,
    'message'=>'offer accepted successfully'

];
}
catch(Exception $e){
    DB::rollBack();
    return [
    'success'=>false,
    'message'=>'offer accepted failed ... something is wrong '

];
}
}
}
