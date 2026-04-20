<?php

namespace Database\Seeders;

use App\Models\V1\Attachment;
use App\Models\V1\Project;
use App\Models\V1\Tag;

use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //attachments for projects,attachments for tags


       //attachments for projects
       $projects=Project::all();
       foreach($projects as $project){
       for($i=0;$i<rand(1,3);$i++){ //each project has 1 to 3 attachments
        Attachment::create([
            'attachable_id'=>$project->id,
            'attachable_type'=>Project::class,
            'file_name'=>$project->title.'pdf',
            'file_path'=>'uploade/'.$project->title.'pdf'

        ]);
       }
       }
        //attachments for tags
        $tags=Tag::all();
        foreach($tags as $tag){
     for($i=0;$i<rand(1,3);$i++){ //each project has 1 to 3 attachments
        Attachment::create([
            'attachable_id'=>$tag->id,
            'attachable_type'=>Tag::class,
            'file_name'=>$tag->name.'pdf',
            'file_path'=>'uploade/'.$tag->name.'pdf'

        ]);
       }
        }
    }
}
