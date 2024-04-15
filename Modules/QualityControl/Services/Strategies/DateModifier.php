<?php

namespace Modules\QualityControl\Services\Strategies;

class DateModifier
{

    /**
     * @param StartDateModificationStrategy $startDateModificationStrategy
     * @param EndDateModificationStrategy $endDateModificationStrategy
     */
    public function __construct(
        private StartDateModificationStrategy $startDateModificationStrategy,
        private EndDateModificationStrategy   $endDateModificationStrategy

    )
    {
        //
    }

    public function modifyDates(): void
    {
        $this->startDateModificationStrategy->modify();
        $this->endDateModificationStrategy->modify();
    }

    public function modifyDate(): void
    {
        $this->startDateModificationStrategy->modify();
    }
}
