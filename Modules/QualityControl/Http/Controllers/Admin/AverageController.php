<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Modules\QualityControl\Entities\Average;
use Modules\QualityControl\Http\Requests\Average\CreateAverageRequest;
use Modules\QualityControl\Services\Average\CreateAverageService;
use Modules\QualityControl\Services\Average\DeleteAverageService;
use Modules\QualityControl\Services\Average\IndexAverageService;
use Modules\QualityControl\Services\Average\UpdateAverageService;

class AverageController extends Controller
{

    /**
     * @param IndexAverageService $indexAverageService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexAverageService $indexAverageService, Request $request): Renderable
    {
        $averages = $indexAverageService->handle($request);
        return view('qualitycontrol::panel.average.index', compact('averages'));
    }

    /**
     * @param CreateAverageService $createAverageService
     * @return Renderable
     */
    public function create(CreateAverageService $createAverageService): Renderable
    {
        $formData = $createAverageService->prepareFormData();
        return view('qualitycontrol::panel.average.create', compact('formData'));
    }

    /**
     * @param CreateAverageRequest $createAverageRequest
     * @param CreateAverageService $createAverageService
     * @return RedirectResponse
     */

    public function store(CreateAverageRequest $createAverageRequest, CreateAverageService $createAverageService): RedirectResponse
    {
        return $createAverageService->handle($createAverageRequest->getDto());
    }

    /**
     * @param UpdateAverageService $updateAverageService
     * @param Average $average
     * @return Renderable
     */
    public function edit(UpdateAverageService $updateAverageService, Average $average): Renderable
    {
        $formData = $updateAverageService->prepareFormData($average);
        return view('qualitycontrol::panel.average.edit', compact('formData'));
    }

    /**
     * @param UpdateAverageService $updateAverageService
     * @param CreateAverageRequest $createAverageRequest
     * @param Average $average
     * @return RedirectResponse
     */
    public function update(UpdateAverageService $updateAverageService, CreateAverageRequest $createAverageRequest, Average $average): RedirectResponse
    {
        return $updateAverageService->handle($createAverageRequest->getDto(), $average['id']);
    }

    /**
     * @param DeleteAverageService $deleteAverageService
     * @param Average $average
     * @return RedirectResponse
     */
    public function destroy(DeleteAverageService $deleteAverageService, Average $average): RedirectResponse
    {
        return $deleteAverageService->handle($average['id']);
    }
}
