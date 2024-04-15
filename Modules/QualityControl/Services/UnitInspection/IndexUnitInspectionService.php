<?php

namespace Modules\QualityControl\Services\UnitInspection;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Contracts\UnitInspection\UnitInspectionInterface;
use Modules\QualityControl\Transformers\Daily\DailyResource;
use Modules\QualityControl\Transformers\UnitInspection\UnitInspectionResource;

class IndexUnitInspectionService
{
    public function __construct(private ?UnitInspectionInterface $unitInspection)
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return UnitInspectionResource::collection($this->unitInspection->all())->toArray($request);
    }
}
