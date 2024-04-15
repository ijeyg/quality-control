<?php

namespace Modules\QualityControl\Transformers\Daily;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;


class DailyResource extends JsonResource
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
            'delivery_weight' => $this->delivery_weight,
            'reject_weight' => $this->reject_weight,
            'accept_weight' => $this->accept_weight,
            'created_at' => Jalalian::forge($this->created_at)->format('Y/m/d')
        ];
    }
}
