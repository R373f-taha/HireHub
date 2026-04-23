<?php

namespace App\Http\Resources\V1\Project;

use App\Http\Requests\V1\Project\CreateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'title'=>strtoupper($this->title),
          'descriptiopn'=>strtolower($this->description),
         'budget'=>$this->budget,
           'type_of_balance'=>$this->type_of_balance,
           'deadline_days_left' => $this->deadlineDaysLeft,
           'project_status'=>$this->project_status,
           'deadline'=>$this->deadline,
           'client_id'=>$this->client_id,
           'client' => $this->whenLoaded('client'),
           'tags' =>$this->whenLoaded('tags')


        ];
    }
}
