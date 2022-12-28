<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cat_id' =>$this->cat_id,
            'name_en' => $this->name('en'),
            'name_ar' => $this->name('ar'),
            'img' => asset("uploads/$this->img"),
            'active' => $this->active,
            'created_at' => $this->created_at,
            'exams'=> ExamResource::collection($this->whenLoaded(('exams'))),
        ];
    }
}
