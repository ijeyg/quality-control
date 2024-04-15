<?php

namespace Modules\QualityControl\Services\Machine;


use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\Entities\Machine;
use Modules\QualityControl\Transformers\Machine\MachineResource;

class SingleMachineService
{
    public function __construct(private ?MachineInterface $machineRepository)
    {
        //
    }

    /**
     * @param Machine $machine
     * @return mixed
     */
    public function handle(Machine $machine): mixed
    {
        return (new MachineResource($this->machineRepository->getById($machine['id'])))->resource;
    }
}
