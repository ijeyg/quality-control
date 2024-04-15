<?php

namespace Modules\QualityControl\Transformers\UnitInspection;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;


class UnitInspectionResource extends JsonResource
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
            'head_shift_name' => $this->head_shift_name,
            'head_noonday' => $this->head_noonday,
            'place' => $this->place,
            'created_at' => Jalalian::forge($this->created_at)->format('Y/m/d')
        ];
    }
}
