<?php

namespace Modules\QualityControl\Services\Daily;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Entities\Daily;

class DeleteDailyService
{
    public function __construct(private ?DailyInterface $daily)
    {
        //
    }

    public function handle(Daily $daily): RedirectResponse
    {
        $daily->values()->delete();
        $this->daily->delete($daily['id']);
        return redirect()->back()->with(['message' => 'فرم روزانه با موفقیت حذف شد']);
    }
}
