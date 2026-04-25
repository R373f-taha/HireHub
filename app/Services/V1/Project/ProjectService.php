<?php

namespace App\Services\V1\Project;

use App\Actions\V1\Project\CreateProjectAction;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Http\Resources\V1\Project\ProjectResource;
use App\Models\V1\Project;
use Illuminate\Support\Facades\Cache;


class ProjectService{

/**
 * تنفيذ عملية حساسة مع قفل تلقائي لمنع التنفيذ المتزامن
 *
 * هذا الأسلوب يستخدم نمط "Critical Section" مع Blocking Lock،
 * وهو بديل آمن عن كتابة try-catch-finally يدوياً مع Cache::lock().
 *
 * يمنع هذا الأسلوب مشكلة Cache Stampede حيث:
 * - عند انتهاء صلاحية الكاش،
 * - طلب واحد فقط يقوم بإعادة حسابه،
 * - وجميع الطلبات الأخرى تنتظر (لا تذهب إلى قاعدة البيانات).
 *
 * الميزات:
 * - Blocking: الطلبات الفاشلة تنتظر وليس تفشل فوراً.
 * - Double-check: بعد الحصول على القفل، تتأكد من الحاجة للتنفيذ.
 * - Auto-release: يحرر القفل تلقائياً حتى لو حدث Exception.
 * - Timeout: يحرر القفل تلقائياً بعد المدة المحددة.

 */
public function index(){


    $projects=Cache::remember('projects',3600,function(){

   return  Cache::withoutOverlapping('projects-lock',function(){//withoutOverlapping)() = block + try +finally

    $data=Project::with('client')->where('project_status','open')->with('tags')->paginate(15);

          Cache::put('projects',$data,3600);

          return $data;
    },60);

    });


    return  ProjectResource::collection($projects);
}

public function show($id){

$project=Project::with(['offers','client','attachments'])->findOrFail($id);

$review=($project->project_status==='closed') ? $project->review: ' project status is not closed so this project doesn`t have any review ';

    return [
        'details' => [
            'project' => $project,
            'offers' => $project->offers,
            'attachments' => $project->attachments,
            'reviews' => $review
        ]
    ];
}
public function createProject(CreateProjectRequest $request,CreateProjectAction $action){

$data=$request->validated();

$data['budget']=json_encode($data['budget']);

$project=$action->execute($data);


if($project){

    Cache::forget('projects');

    return ['success'=>true,'project'=>$project];
}

else return ['success'=>false];
}

}
