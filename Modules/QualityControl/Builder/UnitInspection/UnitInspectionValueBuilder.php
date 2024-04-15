<?php

namespace Modules\QualityControl\Builder\UnitInspection;

use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;
use Modules\QualityControl\Entities\UnitInspectionValue;
use Modules\QualityControl\Services\Strategies\SumCalculationStrategy;

class UnitInspectionValueBuilder implements QualityControlValueBuilderInterface
{
    /**
     * @var UnitInspectionValue
     */
    private UnitInspectionValue $unitInspectionValue;

    private SumCalculationStrategy $calculationStrategy;


    /**
     *
     */
    public function __construct()
    {
        $this->unitInspectionValue = new UnitInspectionValue();
        $this->calculationStrategy = new SumCalculationStrategy();
    }

    /**
     * @param array $values
     * @return QualityControlValueBuilderInterface
     */
    public function setAttributes(array $values): QualityControlValueBuilderInterface
    {
        $this->unitInspectionValue->setParentId($values['parent_id']);
        $this->unitInspectionValue->setProductId($values['product_id']);
        $this->unitInspectionValue->setMachineId($values['machine_id']);
        $this->unitInspectionValue->setCount($values['count']);
        $this->unitInspectionValue->setStatusPackaging($values['status_packaging']);
        $this->unitInspectionValue->setWater($values['water']);
        $this->unitInspectionValue->setOil($values['oil']);
        $this->unitInspectionValue->setPollution($values['pollution']);
        $this->unitInspectionValue->setMembrane($values['membrane']);
        $this->unitInspectionValue->setRupture($values['rupture']);
        $this->unitInspectionValue->setHumidity($values['humidity']);
        $this->unitInspectionValue->setBurn($values['burn']);
        $this->unitInspectionValue->setWrinkles($values['wrinkles']);
        $this->unitInspectionValue->setWeight($values['weight']);
        $this->unitInspectionValue->setTotal($this->calculationStrategy->calculate($values));
        return $this;
    }

    /**
     * @return UnitInspectionValue
     */
    public function getResult(): UnitInspectionValue
    {
        return $this->unitInspectionValue;
    }
}
