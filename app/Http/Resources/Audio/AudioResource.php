<?php

namespace App\Http\Resources\Audio;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioResource extends JsonResource
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
            'url'=>!empty($this->url) ? env('APP_URL')."/audios/".$this->url:null,
            'dubauthor'=>new AudiDubAuthorResource($this->dubauthor),
        ];
    }
}
