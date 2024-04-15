<?php

namespace Modules\QualityControl\DTO\Testing;

use Carbon\Carbon;

class CreateTestingDto
{
    /**
     * @param string|nullstring $code
     * @param int $morning
     * @param int $night
     * @param int $period
     * @param string|null $description
     * @param string|null $head
     * @param string|null $created_at
     * @param array $values
     */
    public function __construct(
        private ?string  $code,
        private int     $morning,
        private int     $night,
        private int     $period,
        private ?string $description,
        private ?string $head,
        private ?string $created_at,
        private array   $values,
    )
    {
        //
    }

    /**
     * @param array $value
     * @return self
     */
    public static function fromArray(array $value): self
    {
        return new self(
            $value['code'],
            $value['morning'],
            $value['night'],
            $value['period'],
            $value['description'] ?? null,
            $value['head'] ?? null,
            Carbon::createFromTimestamp($value['created_at'])->toDateTimeString(),
            $value['values'],
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'morning' => $this->morning,
            'night' => $this->night,
            'head' => $this->head,
            'period' => $this->period,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'values' => $this->values,
        ];
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getMorning(): int
    {
        return $this->morning;
    }

    /**
     * @return int
     */
    public function getNight(): int
    {
        return $this->night;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @return string|null
     */
    public function getHead(): ?string
    {
        return $this->head;
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
