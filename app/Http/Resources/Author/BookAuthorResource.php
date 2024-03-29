<?php

namespace App\Http\Resources\Author;

use Illuminate\Http\Resources\Json\JsonResource;

class BookAuthorResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'author'=>[
                'id'=>$this->author->id,
                'name'=>$this->author->name,
            ],
            'title'=>$this->title,
            'price'=>$this->price,
            'image'=>!empty($this->photo->file) ? env('APP_URL')."/images/".$this->photo->file:null,
            'audios'=>[!empty($this->audios->first()->url) ? env('APP_URL')."/audios/".$this->audios->first()->url:null],
            'rating'=>$this->rating,
            'baskets'=>count($this->basket),
            'favorite'=>count($this->favorite)
        ];
    }
}
