<?php

namespace Modules\QualityControl\Transformers\Reject;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class RejectResource extends JsonResource
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
            'shift' => $this->shift,
            'head_noonday' => $this->head_noonday,
            'created_at' => Jalalian::forge($this->created_at)->format('Y/m/d')
        ];
    }
}
