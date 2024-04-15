<?php

namespace Modules\QualityControl\Builder\UnitInspection;

use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Entities\UnitInspection;

class UnitInspectionBuilder implements QualityControlBuilderInterface
{
    /**
     * @var UnitInspection
     */
    private UnitInspection $unitInspection;

    /**
     *
     */
    public function __construct()
    {
        $this->unitInspection = new UnitInspection();
    }

    /**
     * @param array $values
     * @return self
     */
    public function setAttributes(array $values): self
    {
        $this->unitInspection->setCode($values['code']);
        $this->unitInspection->setShift($values['shift']);
        $this->unitInspection->setPeriod($values['period']);
        $this->unitInspection->setPlace($values['place']);
        $this->unitInspection->setHeadShiftName($values['head_shift_name']);
        $this->unitInspection->setHeadNoonday($values['head_noonday']);
        $this->unitInspection->setCreatedAt($values['created_at']);
        return $this;
    }

    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed
    {
        $value = (new UnitInspectionValueBuilder())->setAttributes($values)->getResult();
        $value->save();
        return $value;
    }
    public function setWater($value): void
    {
        $this->unitInspection->setWater($value);
    }

    public function setOil($value): void
    {
        $this->unitInspection->setOil($value);
    }

    public function setPollution($value): void
    {
        $this->unitInspection->setPollution($value);
    }

    public function setMembrane($value): void
    {
        $this->unitInspection->setMembrane($value);
    }

    public function setRupture($value): void
    {
        $this->unitInspection->setRupture($value);
    }

    public function setHumidity($value): void
    {
        $this->unitInspection->setHumidity($value);
    }

    public function setBurn($value): void
    {
        $this->unitInspection->setBurn($value);
    }

    public function setWrinkles($value): void
    {
        $this->unitInspection->setWrinkles($value);
    }

    public function setWeight($value): void
    {
        $this->unitInspection->setWeight($value);
    }

    public function setTotalOfTotal($value): void
    {
        $this->unitInspection->setTotalOfTotal($value);
    }

    public function getResult(): UnitInspection
    {
        return $this->unitInspection;
    }
}
