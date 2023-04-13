<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OneOrderResource extends JsonResource
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
            'book'=>[
                'id'=>$this->book->id,
                'name'=>$this->book->name
            ],
            'user'=>[
                'id'=>$this->user->id,
                'name'=>$this->user->name],

        ];
    }
}