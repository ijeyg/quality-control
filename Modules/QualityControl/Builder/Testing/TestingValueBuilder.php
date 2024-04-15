<?php

namespace Modules\QualityControl\Builder\Testing;

use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Entities\TestingValue;

class TestingValueBuilder implements QualityControlValueBuilderInterface
{
    private TestingValue $testingValue;

    public function __construct()
    {
        $this->testingValue = new TestingValue();
    }

    /**
     * @param array $values
     * @return QualityControlValueBuilderInterface
     */
    public function setAttributes(array $values): QualityControlValueBuilderInterface
    {
        $this->testingValue->setParentId($values['parent_id']);
        $this->testingValue->setMachineId($values['machine_id']);
        $this->testingValue->setProductId($values['product_id']);
        $this->testingValue->setTime($values['time']);
        $this->testingValue->setWater($values['water']);
        $this->testingValue->setOil($values['oil']);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->testingValue;
    }
}
