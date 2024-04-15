<?php

namespace Modules\QualityControl\Contracts\Strategies;

interface CalculationStrategyInterface
{
    public function calculate($values);
}
