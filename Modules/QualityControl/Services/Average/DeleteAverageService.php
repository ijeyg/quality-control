<?php

namespace Modules\QualityControl\Services\Average;


use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Testing\TestingInterface;
use Modules\QualityControl\Repository\Average\AverageRepository;

class DeleteAverageService
{
    public function __construct(private ?AverageRepository $averageRepository)
    {
        //
    }

    public function handle($id): RedirectResponse
    {
        $this->averageRepository->getById($id)->values()->delete();
        $this->averageRepository->delete($id);
        return redirect()->back()->with(['message' => ' با موفقیت حذف شد']);
    }
}
