<?php

namespace App\Services\V1\Review;

use App\Models\V1\Review;

class GetReviewsService{

/**
 *freelancer reviews
 * @param mixed $freelancerId
 * @return array{average_rating: string, data: \Illuminate\Database\Eloquent\Collection<int, Review>|\Illuminate\Support\Collection<int, \stdClass>, total_reviews: int}
 */

public function freelancerReviews($freelancerId){

$reviews=Review::where('freelancer_id',$freelancerId)->with('project.client')->get();

$averageRating=$reviews->average('freelancer_rating');

$stars='☆☆☆☆☆';

    if ($averageRating < 5) {
        $stars = '⭐☆☆☆☆';
    } elseif ($averageRating < 8) {
        $stars = '⭐⭐⭐☆☆';
    } else {
        $stars = '⭐⭐⭐⭐⭐';
    }

  return [

            'average_rating' => round($averageRating, 1).$stars,
            'total_reviews' => $reviews->count(),
            'data' => $reviews
        ];
}
/**
 * claculate project`s review
 * @param mixed $projectId
 * @return array{review: string, success: bool}
 */
public function projectReview($projectId){

$review=Review::where('project_id',$projectId)->with(['freelancer.user','client.user'])->first();

$stars='☆☆☆☆☆';

    if ($review < 5) {
        $stars = '⭐☆☆☆☆';
    } elseif ($review < 8) {
        $stars = '⭐⭐⭐☆☆';
    } else {
        $stars = '⭐⭐⭐⭐⭐';
    }
  return [
            'success' => true,
            'review' => $review.$stars
        ];
}

}
