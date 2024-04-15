<?php

namespace Modules\QualityControl\Services\Machine;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\Entities\Machine;

class DeleteMachineService
{
    public function __construct(private ?MachineInterface $machineRepository)
    {
        //
    }

    /**
     * @param Machine $machine
     * @return RedirectResponse
     */
    public function handle(Machine $machine): RedirectResponse
    {
        $this->machineRepository->delete($machine['id']);
        return redirect()->back()->with(['message' => 'ماشین آلات با موفقیت حذف شد']);
    }
}
