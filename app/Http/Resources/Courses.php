<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Courses extends JsonResource
{
    /**
     * Transform the resource class.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            
            'id' => $this->id,
            'arabic_title'  => $this->getTranslation('title','ar'),
            'english_title' => $this->getTranslation('title','en'),
            'english_desc'  => $this->getTranslation('desc'),
            'arabic_desc'   => $this->getTranslations('title','ar'),
            'img_url'       => $this->getFirstMediaUrl('images'),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
