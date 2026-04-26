<?php

namespace App\Services\V1\Review;

use App\Actions\V1\Review\CreateReviewAction;
use App\Http\Requests\V1\Review\storeReviewRequest;
use App\Jobs\ReviewsAverageJob;
use App\Models\V1\Freelancer;
use App\Models\V1\Project;
use App\Models\V1\Review;

class ReviewService{


/**
 * This method handles the creation of a new review for a freelancer and project after a project is completed and closed.
 * @param storeReviewRequest $request
 * @return array{code: int, data: Review, message: string, success: bool|array{code: int, message: string, success: bool}}
 */
public function store(storeReviewRequest $request){

$project=Project::find($request->project_id);

if($project->project_status!=='closed'){
     return [
                'success' => false,
                'message' => 'Your project is not yet closed, so you cannot evaluate its performance now. Wait until it is closed.t 😑😑',
                'code'=>422
                 ];
}

$acceptedOffer=$project->offers()->where('offer_status','accepted')->first();

       if (!$acceptedOffer) {
            return   [
                'success' => false,
                'message' => 'there is no acceptance freelancer on this project 🧐',
                'code'=>422
            ];
        }


        else  $freelancerId=$acceptedOffer->freelancer_id;


   $action =new CreateReviewAction();

   $data=$request->validated();

   $data['freelancer_id']=$freelancerId;

  $review =$action->execute($data);

$freelancer=Freelancer::where('id',$review['freelancer_id'])->first();

ReviewsAverageJob::dispatch($freelancer)->onQueue('emails');

        return [
            'success' => true,
            'message' => 'your review added successfully and we will send a new average of reviews for freelancer who you review it 😊',
            'data' => $review,
            'code'=>201
        ];

}


}
