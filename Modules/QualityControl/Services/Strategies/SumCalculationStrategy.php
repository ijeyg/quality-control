<?php

namespace Modules\QualityControl\Services\Strategies;

use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;

class SumCalculationStrategy implements CalculationStrategyInterface
{
    public function calculate($values)
    {
        $total = 0;
        unset($values['parent_id'], $values['product_id'],$values['machine_id'],$values['status_packaging']);

        foreach ($values as $value) {
            $total += $value;
        }

        return $total;
    }
}
