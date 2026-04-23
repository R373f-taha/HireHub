<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Review\storeReviewRequest;
use App\Models\V1\Review;
use App\Services\V1\Review\GetReviewsService;
use App\Services\V1\Review\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

protected $reviewService,$getReviewService;

public function __construct(ReviewService $reviewService,GetReviewsService $getReviewsService){

$this->reviewService=$reviewService;
$this->getReviewService=$getReviewsService;
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeReviewRequest $request)
    {
     return   $this->reviewService->store($request);
    }

    public function freelancerReview($freelancerId){

    return $this->getReviewService->freelancerReviews($freelancerId);
    }

    public function  projectReview($projectId){

    return $this->getReviewService->projectReview($projectId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
