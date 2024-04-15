<?php

namespace Modules\QualityControl\Builder\Testing;

use Modules\QualityControl\Contracts\QualityControl\QualityControlBuilderInterface;
use Modules\QualityControl\Entities\Testing;

class TestingBuilder implements QualityControlBuilderInterface
{
    private Testing $testing;

    public function __construct()
    {
        $this->testing = new Testing();
    }

    /**
     * @param array $values
     * @return QualityControlBuilderInterface
     */
    public function setAttributes(array $values): QualityControlBuilderInterface
    {
        $this->testing->setCode($values['code']);
        $this->testing->setMorning($values['morning']);
        $this->testing->setNight($values['night']);
        $this->testing->setHead($values['head']);
        $this->testing->setPeriod($values['period']);
        $this->testing->setDescription($values['description']);
        $this->testing->setCreatedAt($values['created_at']);
        return $this;
    }

    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed
    {
        $value = (new TestingValueBuilder())->setAttributes($values)->getResult();
        $value->save();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->testing;
    }

}
