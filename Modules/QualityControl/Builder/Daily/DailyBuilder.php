<?php

namespace Modules\QualityControl\Builder\Daily;

use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Entities\Daily;

class DailyBuilder implements QualityControlBuilderInterface
{
    private Daily $daily;

    public function __construct()
    {
        $this->daily = new Daily();
    }

    public function setAttributes(array $values): self
    {
        $this->daily->setCode($values['code']);
        $this->daily->setShift($values['shift']);
        $this->daily->setPeriod($values['period']);
        $this->daily->setHeadShiftName($values['head_shift_name']);
        $this->daily->setHeadNoonday($values['head_noonday']);
        $this->daily->setCreatedAt($values['created_at']);
        return $this;
    }

    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed
    {
        $value = (new DailyValueBuilder())->setAttributes($values)->getResult();
        $value->save();
        return $this;
    }

    public function setAcceptWeight($value): void
    {
        $this->daily->setAcceptWeight($value);
    }

    public function setDeliveryWeight($value): void
    {
        $this->daily->setDeliveryWeight($value);
    }

    public function setRejectWeight($value): void
    {
        $this->daily->setRejectWeight($value);
    }
    public function setBoxNumbers($value): void
    {
        $this->daily->setBoxNumbers($value);
    }

    public function getResult(): Daily
    {
        return $this->daily;
    }
}
