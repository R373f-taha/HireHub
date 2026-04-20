<?php
namespace  App\Services\V1\Offer;

use App\Models\V1\Freelancer;
use App\Models\V1\Offer;

class OfferBidService{

public function bid($id){

// please move to performance-fix-bid-api.md file


  $offers= Offer::where('offer_status','accepted')->whereHas('freelancer.profile')->where('freelancer_id',$id)->get();


  $results=[];

  $results['offers'][]=[$offers];

  foreach($offers as $offer){

      $results['profile'][] = [$offer->profileForAcceptedOffer()] ;
      }

      $results['freelancer'][] = [Freelancer::where('id',$id)->get()];

      return  $results;

    }
}
