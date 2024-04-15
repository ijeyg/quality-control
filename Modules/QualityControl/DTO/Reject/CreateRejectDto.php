<?php

namespace Modules\QualityControl\DTO\Reject;

use Carbon\Carbon;

class CreateRejectDto
{
    /**
     * @param string|null $code
     * @param $period
     * @param $shift
     * @param string|null $head_shift_name
     * @param string|null $head_noonday
     * @param string|null $created_at
     * @param $values
     */
    public function __construct(
        private ?string $code,
        private         $period,
        private         $shift,
        private ?string $head_shift_name,
        private ?string $head_noonday,
        private ?string $created_at,
        private         $values,
    )
    {
    }

    /**
     * @param $values
     * @return self
     */
    public static function fromArray($values): self
    {
        return new self(
            $values['code'],
            $values['period'],
            $values['shift'],
            $values['head_shift_name'],
            $values['head_noonday'],
            Carbon::createFromTimestamp($values['created_at'])->toDateTimeString(),
            $values['values'],
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'period' => $this->period,
            'shift' => $this->shift,
            'head_shift_name' => $this->head_shift_name,
            'head_noonday' => $this->head_noonday,
            'created_at' => $this->created_at,
            'values' => $this->values,
        ];
    }

    /**
     * @return mixed
     */
    public function getCode(): mixed
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getPeriod(): mixed
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod(mixed $period): void
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getShift(): mixed
    {
        return $this->shift;
    }

    /**
     * @param mixed $shift
     */
    public function setShift(mixed $shift): void
    {
        $this->shift = $shift;
    }

    /**
     * @return mixed
     */
    public function getHeadShiftName(): mixed
    {
        return $this->head_shift_name;
    }

    /**
     * @param mixed $head_shift_name
     */
    public function setHeadShiftName(mixed $head_shift_name): void
    {
        $this->head_shift_name = $head_shift_name;
    }

    /**
     * @return mixed
     */
    public function getHeadNoonday(): mixed
    {
        return $this->head_noonday;
    }

    /**
     * @param mixed $head_noonday
     */
    public function setHeadNoonday(mixed $head_noonday): void
    {
        $this->head_noonday = $head_noonday;
    }

    /**
     * @return mixed
     */
    public function getValues(): mixed
    {
        return $this->values;
    }


    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }
}
