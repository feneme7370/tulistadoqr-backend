<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use App\Models\Page\Category;
use App\Models\Page\Level;
use App\Models\Page\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price_original' => $this->price_original,
            'price_seller' => $this->price_seller,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'description2' => $this->description2,
            'description3' => $this->description3,
            'status' => $this->status,
            'image_hero' => $this->image_hero,
            'image_hero_uri' => $this->image_hero_uri,
            'category_id' => $this->category_id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'category' => $this->category->name,
            'tags' => $this->tags,
            'company' => $this->company,
            'user' => $this->user,
            'suggestion' => $this->suggestion ? true : false,
            'offer' => (($this->price_original > $this->price_seller) && ($this->price_seller != 0)) ? true : false,
        ];
    }
}
