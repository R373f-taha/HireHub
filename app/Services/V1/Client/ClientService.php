<?php

namespace App\Services\V1\Client;

use App\Jobs\SendNewOfferAcceptedJob;
use App\Jobs\SendOfferRejectedJob;
use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientService{

//public function acceptOffer($project_id,$offer_id){

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
$project=Project::where('id', $project_id)
    ->where('client_id',Auth::user()->client->id)
    ->first();

if(!$project){

    DB::rollBack();

    return ['message'=>'this project not for you so you can not accept any offer for it 😑😑'];}

$freelancer=Freelancer::findOrFail($offer->freelancer_id);

if($project->project_status !=='open')

    return ['message'=>'this project is '.$project->project_status .'  so it`s not open for offers🙄'  ];

$offer->update(['offer_status'=>'accepted']);

$rejectedOffers=Offer::where('project_id',$project_id)->where('id','!=',$offer_id)

->where('offer_status','pending')->get();

foreach($rejectedOffers as $rejectedOffer)

$rejectedOffer->update(['offer_status'=>'rejected']);


$project->update(['project_status'=>'in_progress']);

Cache::forget('projects');

 DB::commit();

SendNewOfferAcceptedJob::dispatch($freelancer,$offer,$project)->onQueue('emails');

foreach($rejectedOffers as $rejectedOffer){

$rejectedFreelancer=Freelancer::findOrFail($rejectedOffer->freelancer_id);

SendOfferRejectedJob::dispatch($rejectedFreelancer,$rejectedOffer,$project)->onQueue('emails');
}
return [
    'message'=>'offer accepted successfully 💛✅  we will send a confirmation email please check your emails box 🤗🤗'

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
