<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Http\Requests\Daily\CreateDailyRequest;
use Modules\QualityControl\Services\Daily\CreateDailyService;
use Modules\QualityControl\Services\Daily\DeleteDailyService;
use Modules\QualityControl\Services\Daily\IndexDailyService;
use Modules\QualityControl\Services\Daily\UpdateDailyService;

class DailyController extends Controller
{

    /**
     * @param IndexDailyService $indexDailyService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexDailyService $indexDailyService, Request $request): Renderable
    {
        $dailies = $indexDailyService->handle($request);
        return view('qualitycontrol::panel.daily.index', compact('dailies'));
    }

    /**
     * @param CreateDailyService $createDailyService
     * @return Renderable
     */
    public function create(CreateDailyService $createDailyService): Renderable
    {
        $formData = $createDailyService->prepareFormData();
        return view('qualitycontrol::panel.daily.create', compact('formData'));
    }

    /**
     * @param CreateDailyRequest $createDailyRequest
     * @param CreateDailyService $createDailyService
     * @return RedirectResponse
     */
    public function store(CreateDailyRequest $createDailyRequest, CreateDailyService $createDailyService): RedirectResponse
    {
        return $createDailyService->handle($createDailyRequest->getDto());
    }

    /**
     * @param UpdateDailyService $updateDailyService
     * @param Daily $daily
     * @return Renderable
     */
    public function edit(UpdateDailyService $updateDailyService, Daily $daily): Renderable
    {
        $formData = $updateDailyService->prepareFormData($daily);
        return view('qualitycontrol::panel.daily.edit', compact('formData'));
    }

    /**
     * @param CreateDailyRequest $createDailyRequest
     * @param UpdateDailyService $updateDailyService
     * @param Daily $daily
     * @return RedirectResponse
     */
    public function update(CreateDailyRequest $createDailyRequest, UpdateDailyService $updateDailyService, Daily $daily): RedirectResponse
    {
        return $updateDailyService->handle($createDailyRequest->getDto(), $daily);
    }

    /**
     * @param DeleteDailyService $deleteDailyService
     * @param Daily $daily
     * @return RedirectResponse
     */
    public function destroy(DeleteDailyService $deleteDailyService, Daily $daily): RedirectResponse
    {
        return $deleteDailyService->handle($daily);
    }
}
