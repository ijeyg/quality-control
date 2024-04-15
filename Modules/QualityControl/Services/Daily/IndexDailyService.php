<?php

namespace Modules\QualityControl\Services\Daily;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Transformers\Daily\DailyResource;

class IndexDailyService
{
    public function __construct(private ?DailyInterface $daily)
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return DailyResource::collection($this->daily->all())->toArray($request);
    }
}
