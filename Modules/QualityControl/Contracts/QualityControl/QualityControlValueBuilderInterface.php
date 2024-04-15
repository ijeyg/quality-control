<?php

namespace Modules\QualityControl\Contracts\QualityControl;

interface QualityControlValueBuilderInterface
{
    /**
     * @param array $values
     * @return self
     */
    public function setAttributes(array $values): self;
    /**
     * @return mixed
     */
    public function getResult(): mixed;
}
