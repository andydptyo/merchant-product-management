<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'price' => $this->whenPivotLoaded('merchant_product', function () {
                return $this->pivot->price;
            })
        ];
    }
}
