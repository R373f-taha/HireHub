<?php

namespace App\Services\V1\Offer;

use App\Actions\V1\Offer\CreateOfferAction;
use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use Illuminate\Http\Request;

use App\Http\Requests\V1\Offer\CreateOfferRequest;
use App\Models\V1\Client;
use App\Models\V1\Project;

class OfferService{

public function applicationForAnOffer(CreateOfferRequest $request,CreateOfferAction $action){

$offer=$action->execute($request->validated());

return $offer;
}
public function index(){

return      Offer::with('freelancer')->with('project')->paginate(10);
}


public function show($offerId){

          $offer=Offer::findOrFail($offerId);


        if($offer->offer_status==='accepted'){
            $freelancer=$offer->freelancer;
            $project=$offer->project;
            return response()->json(['success'=>true,
            'data for accepted offer'=>['offer'=>$offer,'freelancer'=>$freelancer,'project'=>$project]]);
        }

        else  if($offer->offer_status==='rejected'){
           $project=$offer->project;
            return response()->json(['success'=>true,
            'data for rejected offer'=>['offer'=>$offer,'project'=>$project]]);
        }

return response()->json(['offer'=>$offer]);

        }

}
