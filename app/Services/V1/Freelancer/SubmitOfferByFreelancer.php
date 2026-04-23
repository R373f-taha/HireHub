<?php

namespace App\Services\V1\Freelancer;

use App\Actions\V1\Offer\CreateOfferAction;
use App\Http\Requests\V1\Offer\CreateOfferRequest;
use App\Models\V1\Offer;
use App\Models\V1\Project;

class SubmitOfferByFreelancer{


public function submitOffer(CreateOfferRequest $request,CreateOfferAction $action){

    $existingOffer=Offer::where('project_id',$request->project_id)->where('freelancer_id',$request->freelancer_id)->first();

   if($existingOffer)

    return ['success'=>false,'message'=>'this freelancer is already submitted an offer on this project'];

$project=Project::findOrFail($request->project_id);

    if($project->project_status !=='open')

    return ['success'=>false,'message'=>'this project is '.$project->project_status .'so it`s not oppen for offers🙄'  ];

    $offer=$request->validated();

    $offer['status']='pending';

    $offer=$action->execute($offer);



       return [
        'success' => true,
        'message' => 'Offer submitted successfully'
    ];
}
}
