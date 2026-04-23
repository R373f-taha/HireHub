<?php
namespace  App\Services\V1\Offer;

use App\Models\V1\Freelancer;
use App\Models\V1\Offer;

class OfferBidService{


 public function bid($id){

 //please move to the performance-fix-bid-api.md

$result=Offer::with('freelancer.profile')->where('freelancer_id',$id)->where('offer_status','accepted')->get();


 if($result->isEmpty())

    return ['This freelancer doesn\'t have any accepted offers '];

 return $result;

}
}
