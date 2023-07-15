<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
                "name" => $this->name,
                "image" => asset('storage/' . $this->image),
                "link" => $this->link,
                "skill" => new SkillResource($this->skill),
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
        ];
    }
}
