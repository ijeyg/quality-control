<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Modules\QualityControl\Http\Requests\UnitInspection\CreateUnitInspectionRequest;
use Modules\QualityControl\Services\UnitInspection\CreateUnitInspectionService;
use Modules\QualityControl\Services\UnitInspection\DeleteUnitInspectionService;
use Modules\QualityControl\Services\UnitInspection\IndexUnitInspectionService;
use Modules\QualityControl\Services\UnitInspection\UpdateUnitInspectionService;

class UnitInspectionController extends Controller
{
    /**
     * @param IndexUnitInspectionService $indexUnitInspectionService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexUnitInspectionService $indexUnitInspectionService, Request $request): Renderable
    {
        $unitInspections = $indexUnitInspectionService->handle($request);
        return view('qualitycontrol::panel.unitinspection.index', compact('unitInspections'));
    }

    /**
     * @param CreateUnitInspectionService $createUnitInspectionService
     * @return Renderable
     */
    public function create(CreateUnitInspectionService $createUnitInspectionService): Renderable
    {
        $formData = $createUnitInspectionService->prepareFormData();
        return view('qualitycontrol::panel.unitinspection.create', compact('formData'));
    }

    /**
     * @param CreateUnitInspectionRequest $createUnitInspectionRequest
     * @param CreateUnitInspectionService $createUnitInspectionService
     * @return RedirectResponse
     */
    public function store(CreateUnitInspectionRequest $createUnitInspectionRequest, CreateUnitInspectionService $createUnitInspectionService): RedirectResponse
    {
        return $createUnitInspectionService->handle($createUnitInspectionRequest->getDto());
    }

    /**
     * @param UpdateUnitInspectionService $updateUnitInspectionService
     * @param $id
     * @return Renderable
     */
    public function edit(UpdateUnitInspectionService $updateUnitInspectionService, $id): Renderable
    {
        $formData = $updateUnitInspectionService->prepareFormData($id);
        return view('qualitycontrol::panel.unitinspection.edit', compact('formData'));
    }

    /**
     * @param UpdateUnitInspectionService $updateUnitInspectionService
     * @param CreateUnitInspectionRequest $createUnitInspectionRequest
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateUnitInspectionService $updateUnitInspectionService, CreateUnitInspectionRequest $createUnitInspectionRequest, $id): RedirectResponse
    {
        return $updateUnitInspectionService->handle($createUnitInspectionRequest->getDto(), $id);
    }

    /**
     * @param DeleteUnitInspectionService $deleteUnitInspectionService
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(DeleteUnitInspectionService $deleteUnitInspectionService, $id): RedirectResponse
    {
        return $deleteUnitInspectionService->handle($id);
    }
}
