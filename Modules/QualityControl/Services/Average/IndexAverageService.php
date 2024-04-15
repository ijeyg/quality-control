<?php

namespace Modules\QualityControl\Services\Average;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Repository\Average\AverageRepository;
use Modules\QualityControl\Transformers\Average\AverageResource;

class IndexAverageService
{
    /**
     * @param AverageRepository $averageRepository
     */
    public function __construct(
        private AverageRepository $averageRepository
    )
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return AverageResource::collection($this->averageRepository->all())->toArray($request);
    }
}
