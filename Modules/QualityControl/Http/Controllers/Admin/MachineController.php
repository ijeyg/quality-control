<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\QualityControl\Entities\Machine;
use Modules\QualityControl\Http\Requests\Machine\CreateMachineRequest;
use Modules\QualityControl\Services\Machine\CreateMachineService;
use Modules\QualityControl\Services\Machine\DeleteMachineService;
use Modules\QualityControl\Services\Machine\IndexMachineService;
use Modules\QualityControl\Services\Machine\SingleMachineService;
use Modules\QualityControl\Services\Machine\UpdateMachineService;

class MachineController extends Controller
{
    /**
     * @param IndexMachineService $indexMachineService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexMachineService $indexMachineService, Request $request): Renderable
    {
        $machines = $indexMachineService->handle($request);
        return view('qualitycontrol::panel.machines.index', compact('machines'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('qualitycontrol::panel.machines.create');
    }

    /**
     * @param CreateMachineRequest $createMachineRequest
     * @param CreateMachineService $createMachineService
     * @return RedirectResponse
     */
    public function store(CreateMachineRequest $createMachineRequest, CreateMachineService $createMachineService): RedirectResponse
    {
        return $createMachineService->handle($createMachineRequest->getDto());
    }

    /**
     * @param SingleMachineService $singleMachineService
     * @param Machine $machine
     * @return Renderable
     */
    public function edit(SingleMachineService $singleMachineService, Machine $machine): Renderable
    {
        $machine = $singleMachineService->handle($machine);
        return view('qualitycontrol::panel.machines.edit', compact('machine'));
    }

    /**
     * @param CreateMachineRequest $createMachineRequest
     * @param UpdateMachineService $updateMachineService
     * @param Machine $machine
     * @return RedirectResponse
     */
    public function update(CreateMachineRequest $createMachineRequest, UpdateMachineService $updateMachineService, Machine $machine): RedirectResponse
    {
        return $updateMachineService->handle($createMachineRequest->getDto(), $machine);
    }

    /**
     * @param DeleteMachineService $deleteMachineService
     * @param Machine $machine
     * @return RedirectResponse
     */
    public function destroy(DeleteMachineService $deleteMachineService, Machine $machine): RedirectResponse
    {
        return $deleteMachineService->handle($machine);
    }
}
