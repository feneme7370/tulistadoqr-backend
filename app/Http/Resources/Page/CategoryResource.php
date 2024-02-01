<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'image_hero' => $this->image_hero,
            'image_hero_uri' => $this->image_hero_uri,
            'level_id' => $this->level_id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'level' => $this->level,
            'company' => $this->company,
            'user' => $this->user,
        ];
    }
}
