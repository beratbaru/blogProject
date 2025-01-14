<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'image'=>$this->content,
            'activationDate'=>$this->activationDate,
            'slug'=>$this->slug,
            'status'=>$this->status
        ];
    }
}
