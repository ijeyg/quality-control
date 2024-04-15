<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Modules\QualityControl\Http\Requests\Testing\CreateTestingRequest;
use Modules\QualityControl\Services\Testing\CreateTestingService;
use Modules\QualityControl\Services\Testing\DeleteTestingService;
use Modules\QualityControl\Services\Testing\IndexTestingService;
use Modules\QualityControl\Services\Testing\UpdateTestingService;

class TestingController extends Controller
{
    /**
     * @param IndexTestingService $indexTestingService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexTestingService $indexTestingService, Request $request): Renderable
    {
        $testings = $indexTestingService->handle($request);
        return view('qualitycontrol::panel.testing.index', compact('testings'));
    }

    /**
     * @param CreateTestingService $createTestingService
     * @return Renderable
     */
    public function create(CreateTestingService $createTestingService): Renderable
    {
        $formData = $createTestingService->prepareFormData();
        return view('qualitycontrol::panel.testing.create', compact('formData'));
    }

    /**
     * @param CreateTestingRequest $createTestingRequest
     * @param CreateTestingService $createTestingService
     * @return RedirectResponse
     */
    public function store(CreateTestingRequest $createTestingRequest, CreateTestingService $createTestingService): RedirectResponse
    {
        return $createTestingService->handle($createTestingRequest->getDto());
    }

    /**
     * @param UpdateTestingService $updateTestingService
     * @param $id
     * @return Renderable
     */
    public function edit(UpdateTestingService $updateTestingService, $id): Renderable
    {
        $formData = $updateTestingService->prepareFormData($id);
        return view('qualitycontrol::panel.testing.edit', compact('formData'));
    }

    /**
     * @param UpdateTestingService $updateTestingService
     * @param CreateTestingRequest $createTestingRequest
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateTestingService $updateTestingService, CreateTestingRequest $createTestingRequest, $id): RedirectResponse
    {
        return $updateTestingService->handle($createTestingRequest->getDto(), $id);
    }

    /**
     * @param DeleteTestingService $deleteTestingService
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(DeleteTestingService $deleteTestingService, $id): RedirectResponse
    {
        return $deleteTestingService->handle($id);
    }
}
