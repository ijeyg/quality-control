<?php

namespace Modules\QualityControl\Traits;

use Illuminate\Database\Eloquent\Builder;
use Modules\QualityControl\Entities\Average;
use Modules\QualityControl\Entities\AverageValue;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Entities\DailyValue;
use Modules\QualityControl\Entities\Machine;
use Modules\QualityControl\Entities\Product;
use Modules\QualityControl\Entities\Reject;
use Modules\QualityControl\Entities\RejectValue;
use Modules\QualityControl\Entities\Testing;
use Modules\QualityControl\Entities\TestingValue;
use Modules\QualityControl\Entities\UnitInspection;
use Modules\QualityControl\Entities\UnitInspectionValue;

trait QueryTrait
{
    /**
     * @return Builder
     */
    protected function ProductQuery(): Builder
    {
        return Product::query();
    }

    /**
     * @return Builder
     */
    protected function MachineQuery(): Builder
    {
        return Machine::query();
    }

    /**
     * @return Builder
     */
    protected function DailyQuery(): Builder
    {
        return Daily::query();
    }

    /**
     * @return Builder
     */
    protected function DailyValueQuery(): Builder
    {
        return DailyValue::query();
    }

    /**
     * @return Builder
     */
    protected function UnitInspectionQuery(): Builder
    {
        return UnitInspection::query();
    }

    /**
     * @return Builder
     */
    protected function UnitInspectionValueQuery(): Builder
    {
        return UnitInspectionValue::query();
    }

    /**
     * @return Builder
     */
    protected function RejectQuery(): Builder
    {
        return Reject::query();
    }

    /**
     * @return Builder
     */
    protected function RejectValueQuery(): Builder
    {
        return RejectValue::query();
    }

    /**
     * @return Builder
     */
    protected function TestingQuery(): Builder
    {
        return Testing::query();
    }

    /**
     * @return Builder
     */
    protected function TestingValueQuery(): Builder
    {
        return TestingValue::query();
    }

    /**
     * @return Builder
     */
    protected function AverageQuery(): Builder
    {
        return Average::query();
    }

    /**
     * @return Builder
     */
    protected function AverageValueQuery(): Builder
    {
        return AverageValue::query();
    }

}
