<?php

namespace Modules\QualityControl\Services\Strategies;

use Carbon\Carbon;
use Modules\QualityControl\Contracts\Strategies\DateModificationStrategyInterface;

class EndDateModificationStrategy implements DateModificationStrategyInterface
{
    public function modify(): void
    {
        request()->merge(['end_date' => Carbon::createFromTimestamp(request()->input('end_date'))->toDateString()]);
    }
}
