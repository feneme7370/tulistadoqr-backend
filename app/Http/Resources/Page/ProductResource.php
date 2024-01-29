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
            'price_original' => '$' . number_format($this->price_original, 2),
            'price_seller' => '$' . number_format($this->price_seller, 2),
            'quantity' => $this->quantity,
            'description' => $this->description,
            'status' => $this->status,
            'image_hero' => $this->image_hero,
            'image_logo' => $this->image_logo,
            'category_id' => $this->category_id,
            'level_id' => $this->level_id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'category' => $this->category->name,
            'level' => $this->level->name,
            'company_id' => $this->company,
            'user_id' => $this->user,
        ];
    }
}
