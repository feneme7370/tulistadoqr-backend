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
            'times_description' => $this->times_description,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'status' => $this->status,
            'type_menu' => $this->type_menu,
            'list_product' => $this->membership->list_product,
            'image_qr' => $this->image_qr,
            'image_qr_uri' => $this->image_qr_uri,
            'image_logo' => $this->image_logo,
            'image_logo_uri' => $this->image_logo_uri,
            'image_hero' => $this->image_hero,
            'image_hero_uri' => $this->image_hero_uri,
            'membership_id' => $this->membership_id,
            'membership' => $this->membership,
            'socialMedia' => $this->socialMedia,
        ];

    }
}
