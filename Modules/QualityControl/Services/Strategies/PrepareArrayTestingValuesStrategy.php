<?php

namespace Modules\QualityControl\Services\Strategies;

use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;

class PrepareArrayTestingValuesStrategy implements CalculationStrategyInterface
{

    /**
     * @param $values
     * @return array
     */
    public function calculate($values): array
    {
        $array = [];
        foreach ($values as $datum) {
            $machine_id = $datum['machine_id'];
            $product_id = $datum['product_id'];
            unset($datum['machine_id']);
            unset($datum['product_id']);
            foreach ($datum as $value) {
                $array [] = [
                    'machine_id' => $machine_id,
                    'product_id' => $product_id,
                    'water' => $value['water'],
                    'oil' => $value['oil'],
                    'time' => $value['time'],
                ];
            }
        }
        return $array;
    }
}
