<?php

namespace Modules\QualityControl\Builder\Reject;

use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Entities\RejectValue;
use Modules\QualityControl\Services\Strategies\SumCalculationStrategy;

class RejectValueBuilder implements QualityControlValueBuilderInterface
{
    /**
     * @var RejectValue
     */
    private RejectValue $rejectValue;

    private SumCalculationStrategy $calculationStrategy;

    /**
     *
     */
    public function __construct()
    {
        $this->rejectValue = new RejectValue();
        $this->calculationStrategy = new SumCalculationStrategy();
    }


    /**
     * @param array $values
     * @return QualityControlValueBuilderInterface
     */
    public function setAttributes(array $values): QualityControlValueBuilderInterface
    {
        $this->rejectValue->setParentId($values['parent_id']);
        $this->rejectValue->setProductId($values['product_id']);
        $this->rejectValue->setMachineId($values['machine_id']);
        $this->rejectValue->setRunWeight($values['run_weight']);
        $this->rejectValue->setTechnicalWeight($values['technical_weight']);
        $this->rejectValue->setQualityWeight($values['quality_weight']);
        $this->rejectValue->setLineWeight($values['line_weight']);
        $this->rejectValue->setAcceptWeight($values['accept_weight']);
        $this->rejectValue->setTotal($this->calculationStrategy->calculate($values));
        return $this;
    }

    /**
     * @return RejectValue
     */
    public function getResult(): RejectValue
    {
        return $this->rejectValue;
    }
}
