<?php

namespace Modules\QualityControl\Builder\Average;

use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Entities\AverageValue;

class AverageValueBuilder implements QualityControlValueBuilderInterface
{
    private AverageValue $averageValue;

    public function __construct()
    {
        $this->averageValue = new AverageValue();
    }

    /**
     * @param array $values
     * @return QualityControlValueBuilderInterface
     */
    public function setAttributes(array $values): QualityControlValueBuilderInterface
    {
        $this->averageValue->setParentId($values['parent_id']);
        $this->averageValue->setProductId($values['product_id']);
        $this->averageValue->setMachineId($values['machine_id']);
        $this->averageValue->setDesign($values['design']);
        $this->averageValue->setAverage($values['average']);
        return $this;
    }

    /**
     * @return AverageValue
     */
    public function getResult(): AverageValue
    {
        return $this->averageValue;
    }
}
