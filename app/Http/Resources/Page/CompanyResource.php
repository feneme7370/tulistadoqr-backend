<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'adress' => $this->adress,
            'city' => $this->city,
            'social' => $this->social,
            'url' => $this->url,
            'description' => $this->description,
            'status' => $this->status,
            'image_qr' => $this->image_qr,
            'image_logo' => $this->image_logo,
            'image_hero' => $this->image_hero,
            'membership_id' => $this->membership_id,
            'membership' => $this->membership,
            'socialMedia' => $this->socialMedia,
        ];

    }
}
