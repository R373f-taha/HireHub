<?php

namespace App\Http\Resources\V1\Profile;

use App\Models\V1\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

     return [
          'bio'=>strtolower($this->bio),
          'full_name'=>$this->full_name,
          'image'=>$this->avatar,
           'hour_rate'=>$this->hour_rate,
           'portfolio_link' => $this->portfolio_link,
           'phone'=>$this->phone,
           'skills_summary'=>$this->skills_summary,
           'freelancer_id'=>$this->freelancer_id,
           'available_mode' => $this->available_mode,



        ];
    }
}
