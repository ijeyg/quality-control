<?php

namespace Modules\QualityControl\Transformers\Testing;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;


class TestingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'head' => $this->head,
            'night' => $this->night,
            'created_at' => Jalalian::forge($this->created_at)->format('Y/m/d')
        ];
    }
}
