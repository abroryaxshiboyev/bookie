<?php

namespace App\Http\Resources\Basket;

use Illuminate\Http\Resources\Json\JsonResource;

class OneBasketResource extends JsonResource
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
            'id'=>$this->book->id,
            'name'=>$this->book->name,
            'author_name'=>$this->book->author_name,
            'title'=>$this->book->title,
            'price'=>$this->book->price,
        ];
    }
}