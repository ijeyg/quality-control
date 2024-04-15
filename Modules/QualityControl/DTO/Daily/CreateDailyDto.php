<?php

namespace Modules\QualityControl\DTO\Daily;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class CreateDailyDto
{
    /**
     * @param string|null $code
     * @param int $shift
     * @param int $period
     * @param string|null $head_shift_name
     * @param string|null $head_noonday
     * @param string|null $created_at
     * @param array $values
     */
    public function __construct(
        private ?string $code,
        private int     $shift,
        private int     $period,
        private ?string $head_shift_name,
        private ?string $head_noonday,
        private ?string $created_at,
        private array   $values

    )
    {
        //
    }

    public static function fromArray(array $data): CreateDailyDto
    {
        return new self(
            $data['code'],
            $data['shift'],
            $data['period'],
            $data['head_shift_name'],
            $data['head_noonday'],
            Carbon::createFromTimestamp($data['created_at'])->toDateTimeString(),
            $data['values'],
        );
    }

    public function toArray(): array {
        return [
            'code' => $this->code,
            'shift' => $this->shift,
            'period' => $this->period,
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
     * @return string|null
     */
    public function getHeadShift(): ?string
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
     * @return int
     */
    public function getDeliveryWeight(): int
    {
        return $this->delivery_weight;
    }

    /**
     * @return int
     */
    public function getAcceptWeight(): int
    {
        return $this->accept_weight;
    }

    /**
     * @return int
     */
    public function getRejectWeight(): int
    {
        return $this->reject_weight;
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
