<?php

namespace App\Services\V1\Review;

use App\Http\Requests\V1\Review\storeReviewRequest;
use App\Jobs\ReviewsAverageJob;
use App\Models\V1\Freelancer;
use App\Models\V1\Project;
use App\Models\V1\Review;

class ReviewService{

public function store(storeReviewRequest $request){

$project=Project::find($request->project_id);

if($project->project_status!=='closed'){
     return response()->json([
                'success' => false,
                'message' => 'you cannot add a review on not closed project'
            ], 422);
}

$acceptedOffer=$project->offers()->where('offer_status','accepted')->first();

       if (!$acceptedOffer) {
            return response()->json([
                'success' => false,
                'message' => 'there is no acceptance freelancer on this project',
            ], 422);
        }


  $review = Review::create([
            'project_id' => $project->id,
            'freelancer_id' => $acceptedOffer->freelancer_id,
            'client_id' => $request->client_id,
            'freelancer_rating' => $request->freelancer_rating,
            'project_rating' => $request->project_rating,
            'comment' => $request->comment,
        ]);

$freelancer=Freelancer::where('id',$review['freelancer_id'])->first();

ReviewsAverageJob::dispatch($freelancer)->onQueue('emails');



        return response()->json([
            'success' => true,
            'message' => 'your review added successfully',
            'data' => $review
        ], 201);

}


}
