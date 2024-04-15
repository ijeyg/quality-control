<?php

namespace Modules\QualityControl\Services\Testing;


use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Testing\TestingInterface;

class DeleteTestingService
{
    public function __construct(private ?TestingInterface $testing)
    {
        //
    }

    public function handle($id): RedirectResponse
    {
        $this->testing->getById($id)->values()->delete();
        $this->testing->delete($id);
        return redirect()->back()->with(['message' => ' با موفقیت حذف شد']);
    }
}
