<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'skill_id' => $this->skill_id,
            'name_en' => $this->name('en'),
            'name_ar' => $this->name('ar'),
            'desc_en' => $this->desc('en'),
            'desc_ar' => $this->desc('ar'),
            'img' => asset("uploads/$this->img"),
            'active' => $this->active,
            'created_at' => $this->created_at,
            'questions_no' =>$this->questions_no,
            'difficulty' => $this->difficulty,
            'duration_mins' => $this->duration_mins,
            'questions' => QuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}
