<?php

namespace Modules\QualityControl\Services\Machine;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\DTO\Machine\CreateMachineDto;
use Modules\QualityControl\Entities\Machine;

class UpdateMachineService
{
    public function __construct(private ?MachineInterface $machineRepository)
    {
        //
    }

    /**
     * @param CreateMachineDto $createMachineDto
     * @param Machine $machine
     * @return RedirectResponse
     */
    public function handle(CreateMachineDto $createMachineDto, Machine $machine): RedirectResponse
    {
        $this->machineRepository->update(
            [
                'title' => $createMachineDto->getTitle(),
                'description' => $createMachineDto->getDescription()
            ], $machine['id']);
        return redirect()->back()->with(['message' => 'ماشین آلات با موفقیت بروزرسانی شد']);
    }
}
