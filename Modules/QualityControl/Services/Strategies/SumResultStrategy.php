<?php

namespace Modules\QualityControl\Services\Strategies;

use Modules\QualityControl\Contracts\Strategies\SumResultStrategyInterface;

class SumResultStrategy implements SumResultStrategyInterface
{
    public function sum(array $array, string $field): float
    {
        return array_sum(array_column($array, $field));
    }
}
