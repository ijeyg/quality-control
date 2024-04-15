<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;
use Modules\QualityControl\Http\Requests\Reject\CreateRejectRequest;
use Modules\QualityControl\Services\Reject\CreateRejectService;
use Modules\QualityControl\Services\Reject\DeleteRejectService;
use Modules\QualityControl\Services\Reject\IndexRejectService;
use Modules\QualityControl\Services\Reject\UpdateRejectService;

class RejectController extends Controller
{

    /**
     * @param IndexRejectService $indexRejectService
     * @param Request $request
     * @return Renderable
     */
    public function index(IndexRejectService $indexRejectService, Request $request): Renderable
    {
        $rejects = $indexRejectService->handle($request);
        return view('qualitycontrol::panel.reject.index', compact('rejects'));
    }

    /**
     * @param CreateRejectService $createRejectService
     * @return Renderable
     */
    public function create(CreateRejectService $createRejectService): Renderable
    {
        $formData = $createRejectService->prepareFormData();
        return view('qualitycontrol::panel.reject.create', compact('formData'));
    }


    /**
     * @param CreateRejectService $createRejectService
     * @param CreateRejectRequest $rejectRequest
     * @return RedirectResponse
     */
    public function store(CreateRejectService $createRejectService, CreateRejectRequest $rejectRequest): RedirectResponse
    {
        return $createRejectService->handle($rejectRequest->getDto());
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateRejectService $updateRejectService
     * @param int $id
     * @return Renderable
     */
    public function edit(UpdateRejectService $updateRejectService, $id): Renderable
    {
        $formData = $updateRejectService->prepareFormData($id);
        return view('qualitycontrol::panel.reject.edit', compact('formData'));
    }

    /**
     * @param CreateRejectRequest $rejectRequest
     * @param UpdateRejectService $updateRejectService
     * @param $id
     * @return RedirectResponse
     */
    public function update(CreateRejectRequest $rejectRequest, UpdateRejectService $updateRejectService, $id): RedirectResponse
    {
        return $updateRejectService->handle($rejectRequest->getDto(), $id);
    }

    /**
     * @param DeleteRejectService $deleteRejectService
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(DeleteRejectService $deleteRejectService, $id): RedirectResponse
    {
        return $deleteRejectService->handle($id);
    }
}
