<?php

namespace Modules\QualityControl\Services\UnitInspection;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Contracts\UnitInspection\UnitInspectionInterface;
use Modules\QualityControl\Entities\Daily;

class DeleteUnitInspectionService
{
    public function __construct(private ?UnitInspectionInterface $unitInspection)
    {
        //
    }

    public function handle($id): RedirectResponse
    {
        $this->unitInspection->getById($id)->values()->delete();
        $this->unitInspection->delete($id);
        return redirect()->back()->with(['message' => ' با موفقیت حذف شد']);
    }
}
