<?php

namespace Modules\QualityControl\Contracts\QualityControl;

interface QualityControlBuilderInterface
{
    /**
     * @param array $values
     * @return self
     */
    public function setAttributes(array $values): self;
    /**
     * @param array $values
     * @return mixed
     */
    public function addValue(array $values): mixed;

    /**
     * @return mixed
     */
    public function getResult(): mixed;
}
