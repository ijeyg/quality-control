<?php

namespace Modules\QualityControl\Builder\Reject;

use Modules\QualityControl\Builder\UnitInspection\UnitInspectionValueBuilder;
use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Entities\Reject;
use Modules\QualityControl\Entities\UnitInspection;

class RejectBuilder implements QualityControlBuilderInterface
{
    /**
     * @var Reject
     */
    private Reject $reject;

    /**
     *
     */
    public function __construct()
    {
        $this->reject = new Reject();
    }

    /**
     * @param array $values
     * @return self
     */
    public function setAttributes(array $values): self
    {
        $this->reject->setCode($values['code']);
        $this->reject->setShift($values['shift']);
        $this->reject->setPeriod($values['period']);
        $this->reject->setHeadShiftName($values['head_shift_name']);
        $this->reject->setHeadNoonday($values['head_noonday']);
        $this->reject->setCreatedAt($values['created_at']);
        return $this;
    }

    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed
    {
        $value = (new RejectValueBuilder())->setAttributes($values)->getResult();
        $value->save();
        return $value;
    }

    public function setRunWeight($run_weight): void
    {
        $this->reject->setRunWeight($run_weight); // Fixed here
    }

    public function setTechnicalWeight($technical_weight): void
    {
        $this->reject->setTechnicalWeight($technical_weight); // Fixed here
    }

    public function setQualityWeight($quality_weight): void
    {
        $this->reject->setQualityWeight($quality_weight); // Fixed here
    }

    public function setTotal($total): void
    {
        $this->reject->setTotal($total); // Fixed here
    }

    public function setHeadShiftName($head_shift_name): void
    {
        $this->reject->setHeadShiftName($head_shift_name);
    }

    public function setHeadNoonday($head_noonday): void
    {
        $this->reject->setHeadNoonday($head_noonday);
    }

    public function setLineWeight($line_weight): void
    {
        $this->reject->setLineWeight($line_weight);
    }

    public function setAcceptWeight($value): void
    {
        $this->reject->setAcceptWeight($value);
    }
    /**
     * @return mixed
     */
    public function getResult(): Reject
    {
        return $this->reject;
    }
}
