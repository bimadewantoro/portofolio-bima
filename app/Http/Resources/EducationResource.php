<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
                "id" => $this->id,
                "school" => $this->school,
                "degree" => $this->degree,
                "field" => $this->field,
                "start_date" => $this->start_date,
                "end_date" => $this->end_date,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
        ];
    }
}
