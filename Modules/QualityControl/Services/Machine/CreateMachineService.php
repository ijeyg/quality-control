<?php

namespace Modules\QualityControl\Services\Machine;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\DTO\Machine\CreateMachineDto;

class CreateMachineService
{
    public function __construct(private ?MachineInterface $machineRepository)
    {
        //
    }

    /**
     * @param CreateMachineDto $createMachineDto
     * @return RedirectResponse
     */
    public function handle(CreateMachineDto $createMachineDto): RedirectResponse
    {
        $this->machineRepository->create([
            "title" => $createMachineDto->getTitle(),
            "description" => $createMachineDto->getDescription()
        ]);
        return redirect()->back()->with(['message' => 'ماشین آلات با موفقیت اضافه شد']);
    }
}
