<?php

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\FreelancerController;
use App\Http\Controllers\Api\V1\OffersController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('V1/')->group(function(){


Route::get('offer/{offerId}',[OffersController::class,'show']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('bid/{f}',[OffersController::class,'getbid']);
Route::post('users/register',[UserController::class,'register']);
Route::get('offers',[OffersController::class,'index']);
Route::get('freelancer/{freelancerId}/reviews',[ReviewController::class,'freelancerReview']);
Route::get('project/{projectId}/reviews',[ReviewController::class,'projectReview']);
Route::get('client/{clientId}/reviews',[ReviewController::class,'clientReview']);
Route::get('freelancers/available/verified',[FreelancerController::class,'availableAndVerifiedFreelancers']);
Route::get('freelancers/available/verified/sorted',[FreelancerController::class,'getAvailableVerifiedFreelancersSorted']);
Route::get('freelancers/active',[FreelancerController::class,'getAvailableVerifiedAndActiveFreelancers']);
Route::get('admin/panel',[AdminController::class,'adminPanel'])->middleware(['auth:sanctum','is_admin']);



});

Route::prefix('V1/')->group(function(){

Route::middleware(['auth:sanctum','is_verified_freelancer'])->group(function(){

Route::post('/profile',[ProfileController::class,'store']);
Route::patch('/profile/{id}',[ProfileController::class,'update']);//ckeck each freelancer edit only his profile
Route::Post('/offer',[OffersController::class,'store']);
Route::post('freelancer/offer/submit',[FreelancerController::class,'submitOffer']);
Route::post('/skill/with/{years_of_experience}',[SkillController::class,'store']);
Route::patch('/skill/{id}/with/{years_of_experience}',[SkillController::class,'update']);





});});


Route::prefix('V1/')->group(function(){

    Route::middleware(['auth:sanctum','is_client'])->group(function(){

    Route::post('project/',[ProjectController::class,'store']);
    Route::post('projects/{project_id}/offers/{offer_id}/accept',[ClientController::class,'acceptOffer']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::post('reviews',[ReviewController::class,'store']);

});});

