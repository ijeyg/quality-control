<?php

namespace Modules\QualityControl\Builder\Average;

use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Entities\Average;

class AverageBuilder implements QualityControlBuilderInterface
{
    private Average $average;

    public function __construct()
    {
        $this->average = new Average();
    }

    public function setAttributes(array $values): self
    {
        $this->average->setCreatedAt($values['created_at']);
        $this->average->setPeriod($values['period']);
        $this->average->setShift($values['shift']);
        $this->average->setTime($values['time']);
        return $this;
    }

    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed
    {
        $value = (new AverageValueBuilder())->setAttributes($values)->getResult();
        $value->save();
        return $this;
    }

    public function setDesign($design): void
    {
        $this->average->setDesign($design);
    }

    public function setAverage($average): void
    {
        $this->average->setAverage($average);
    }

    public function getResult(): Average
    {
        return $this->average;
    }
}
