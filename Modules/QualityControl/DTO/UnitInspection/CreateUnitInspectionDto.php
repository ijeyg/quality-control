<?php

namespace Modules\QualityControl\DTO\UnitInspection;

use Carbon\Carbon;

class CreateUnitInspectionDto
{
    /**
     * @param string|null $code
     * @param int $shift
     * @param int $period
     * @param int $place
     * @param string|null $head_shift_name
     * @param string|null $head_noonday
     * @param string|null $created_at
     * @param array $values
     */
    public function __construct(
        private ?string $code,
        private int     $shift,
        private int     $period,
        private int     $place,
        private ?string $head_shift_name,
        private ?string $head_noonday,
        private ?string $created_at,
        private array   $values
    )
    {
    }

    /**
     * @param array $data
     * @return CreateUnitInspectionDto
     */
    public static function fromArray(array $data): CreateUnitInspectionDto
    {
        return new self(
            $data['code'],
            $data['shift'],
            $data['period'],
            $data['place'],
            $data['head_shift_name'],
            $data['head_noonday'],
            Carbon::createFromTimestamp($data['created_at'])->toDateTimeString(),
            $data['values'],
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'shift' => $this->shift,
            'period' => $this->period,
            'place' => $this->place,
            'head_shift_name' => $this->head_shift_name,
            'head_noonday' => $this->head_noonday,
            'created_at' => $this->created_at,
            'values' => $this->values
        ];
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getShift(): int
    {
        return $this->shift;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

    /**
     * @return string|null
     */
    public function getHeadShiftName(): ?string
    {
        return $this->head_shift_name;
    }

    /**
     * @return string|null
     */
    public function getHeadNoonday(): ?string
    {
        return $this->head_noonday;
    }

    /**
     * @return array
     */
    public function getValues(): array
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
