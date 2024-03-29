<?php

namespace App\Http\Resources\Order;

use App\Models\User;
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
            'created_at'=>$this->created_at,
            'status'=>$this->status,
            'book'=>[
                'id'=>$this->book->id,
                'name'=>$this->book->name
            ],
            'user'=>[
                'id'=>$this->user->id,
                'name'=>$this->user->name,
                'phone'=>$this->user->phone,
                'image'=>!empty(User::find($this->user->id)->photo->file) ? env('APP_URL')."/images/".User::find($this->user->id)->photo->file: null
            ],

        ];
    }
}
