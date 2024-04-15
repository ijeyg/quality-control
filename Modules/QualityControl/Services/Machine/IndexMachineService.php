<?php

namespace Modules\QualityControl\Services\Machine;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\Transformers\Machine\MachineResource;

class IndexMachineService
{
    public function __construct(private ?MachineInterface $machineRepository)
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return MachineResource::collection($this->machineRepository->all())->toArray($request);
    }
}
