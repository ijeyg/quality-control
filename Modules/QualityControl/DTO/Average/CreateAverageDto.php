<?php

namespace Modules\QualityControl\DTO\Average;

use Carbon\Carbon;

class CreateAverageDto
{
    public function __construct(
        private int     $period,
        private int     $shift,
        private ?string $time,
        private ?string $created_at,
        private         $values,
    )
    {
        //
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): CreateAverageDto
    {
        return new self(
            $data['period'],
            $data['shift'],
            $data['time'] ?? null,
            Carbon::createFromTimestamp($data['created_at'])->toDateTimeString(),
            $data['values']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'period' => $this->getPeriod(),
            'shift' => $this->getShift(),
            'time' => $this->getTime(),
            'created_at' => $this->getCreatedAt(),
            'values' => $this->getValues(),
        ];
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @return string|null
     */
    public function getTime(): ?string
    {
        return $this->time;
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

    public function getValues()
    {
        return $this->values;
    }
}
