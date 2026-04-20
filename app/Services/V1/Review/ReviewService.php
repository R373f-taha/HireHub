<?php

namespace App\Services\V1\Review;

use App\Http\Requests\V1\Review\storeReviewRequest;
use App\Models\V1\Project;
use App\Models\V1\Review;

class ReviewService{

public function store(storeReviewRequest $request){

$project=Project::find($request->project_id);

if($project->project_status!=='closed'){
     return response()->json([
                'success' => false,
                'message' => 'you acnnot add a review on not closed project'
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

        return response()->json([
            'success' => true,
            'message' => 'your review added successfully',
            'data' => $review
        ], 201);

}

public function freelancerReviews($freelancerId){

$reviews=Review::where('freelancer_id',$freelancerId)->with('project.client')->get();

$averageRating=$reviews->average('freelancer_rating');
  return response()->json([
            'success' => true,
            'average_rating' => round($averageRating, 1),
            'total_reviews' => $reviews->count(),
            'data' => $reviews
        ]);
}

public function projectReview($projectId){

$review=Review::where('project_id',$projectId)->with(['freelancer.user','client.user'])->first();


  return response()->json([
            'success' => true,
            'review' => $review
        ]);
}
}
