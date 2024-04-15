<?php

namespace Modules\QualityControl\Services\Testing;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Testing\TestingInterface;
use Modules\QualityControl\Transformers\Testing\TestingResource;

class IndexTestingService
{
    /**
     * @param TestingInterface|null $testing
     */
    public function __construct(
        private ?TestingInterface $testing
    )
    {
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return TestingResource::collection($this->testing->all())->toArray($request);
    }
}
