<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuggestionResource extends JsonResource
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
            'product_id' => $this->product_id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'product' => $this->product,
            'tags' => $this->product->tags,
            'company' => $this->company,
            'user' => $this->user,
        ];
    }
}
