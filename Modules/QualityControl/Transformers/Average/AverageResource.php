<?php

namespace Modules\QualityControl\Transformers\Average;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class AverageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'shift' => $this->shift,
            'period' => $this->period,
            'time' => $this->time,
            'design' => $this->design,
            'average' => $this->average,
            'created_at' => Jalalian::forge($this->created_at)->format('Y/m/d')
        ];
    }
}
