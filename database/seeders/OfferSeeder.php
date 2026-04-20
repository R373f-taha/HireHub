<?php

namespace Database\Seeders;

use App\Models\V1\Freelancer;
use App\Models\V1\Offer;
use App\Models\V1\Project;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $freelancers=Freelancer::all();
      $openProjects=Project::where('project_status','open')->get();
     $offers=[];

      foreach($openProjects as $project){
        $offerCount=rand(3,8);// each open project recieves from 3 to 8 offer
        $randomFreelancers=$freelancers->random(min($offerCount,$freelancers->count()));
        foreach($randomFreelancers as $freelancer){
            $offers[]=[
                'proposed_amount'=>rand(100,1500),
                 'submission_letter'=>fake()->paragraph(),
                 'delivered_days'=>rand(5,60),
                 'offer_status'=>'pending',
                 'project_id'=>$project->id ,// this offers for this project
                 'freelancer_id'=>$freelancer->id
            ];
        }

      }
      Offer::insert($offers);
    //   $offers=Project::with('offers');
    //   foreach($offers as $offer){
    //     $offer->update(['offer_status'=>'rejected']);
    //   }
    $openProjects->load('offers');

      foreach($openProjects as $project){

        $offerCollection=$project->offers;

        // $offers=$project->offers()->get();

        Offer::where('project_id',$project->id)->update(['offer_status'=>'rejected']);

       $offer=$offerCollection->first();

        Offer::where('id',$offer->id)->update(['offer_status'=>'accepted']);


      }

    // $freelancers=Freelancer::all();


    //     foreach($offers as $offer){
    //     $randomFreelancer=$freelancers->random(rand(1,10));
    //      $offer->freelancers()->attach($randomFreelancer);
    //   }


    }
}
