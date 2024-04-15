<?php

namespace Modules\QualityControl\Contracts\Strategies;

interface SumResultStrategyInterface
{
    public function sum(array $array, string $field);
}
