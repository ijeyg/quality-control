<?php

namespace Modules\QualityControl\Services\Strategies;

use Carbon\Carbon;
use Modules\QualityControl\Contracts\Strategies\DateModificationStrategyInterface;

class StartDateModificationStrategy implements DateModificationStrategyInterface
{
    public function modify(): void
    {
        request()->merge(['start_date'=> Carbon::createFromTimestamp(request()->input('start_date'))->toDateString()]);
    }
}
