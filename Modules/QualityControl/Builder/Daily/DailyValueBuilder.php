<?php

namespace Modules\QualityControl\Builder\Daily;

use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Contracts\QualityControl\QualityControlValueBuilderInterface;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Entities\DailyValue;

class DailyValueBuilder implements QualityControlValueBuilderInterface
{
    private DailyValue $dailyValue;

    public function __construct()
    {
        $this->dailyValue = new DailyValue();
    }

    public function setAttributes(array $values): QualityControlValueBuilderInterface
    {
        $this->dailyValue->setParentId($values['parent_id']);
        $this->dailyValue->setProductId($values['product_id']);
        $this->dailyValue->setMachineId($values['machine_id']);
        $this->dailyValue->setAcceptWeight($values['accept_weight']);
        $this->dailyValue->setBoxNumbers($values['box_numbers']);
        $this->dailyValue->setDeliveryWeight($values['delivery_weight']);
        $this->dailyValue->setRejectWeight($values['reject_weight']);
        $this->dailyValue->setDescription($values['description']);
        return $this;
    }

    public function getResult(): DailyValue
    {
        return $this->dailyValue;
    }
}
