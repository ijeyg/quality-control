<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Daily extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'quality_control_daily';

    /**
     * @var string[]
     */
    protected $fillable = ['code', 'period', 'box_numbers', 'shift', 'delivery_weight', 'accept_weight', 'reject_weight', 'head_shift_name', 'head_noonday', 'created_at'];

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(DailyValue::class, "parent_id", "id");
    }

    /**
     * @return mixed
     */
    public function getBoxNumbers(): mixed
    {
        return $this->box_numbers;
    }

    /**
     * @param string $box_numbers
     * @return void
     */
    public function setBoxNumbers(string $box_numbers): void
    {
        $this->box_numbers = $box_numbers;
    }

    /**
     * @return mixed
     */
    public function getCode(): mixed
    {
        return $this->code;
    }

    /**
     * @param ?string $code
     * @return void
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @param $value
     * @return void
     */
    public function setCreatedAt($value): void
    {
        $this->created_at = $value;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getPeriod(): mixed
    {
        return $this->period;
    }

    /**
     * @param int $period
     * @return void
     */
    public function setPeriod(int $period): void
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
     * @param int $shift
     * @return void
     */
    public function setShift(int $shift): void
    {
        $this->shift = $shift;
    }

    /**
     * @return mixed
     */
    public function getDeliveryWeight(): mixed
    {
        return $this->delivery_weight;
    }

    /**
     * @param float $delivery_weight
     * @return void
     */
    public function setDeliveryWeight(float $delivery_weight): void
    {
        $this->delivery_weight = $delivery_weight;
    }

    /**
     * @return mixed
     */
    public function getAcceptWeight(): mixed
    {
        return $this->accept_weight;
    }

    /**
     * @param float $accept_weight
     * @return void
     */
    public function setAcceptWeight(float $accept_weight): void
    {
        $this->accept_weight = $accept_weight;
    }

    /**
     * @return mixed
     */
    public function getRejectWeight(): mixed
    {
        return $this->reject_weight;
    }

    /**
     * @param float $reject_weight
     * @return void
     */
    public function setRejectWeight(float $reject_weight): void
    {
        $this->reject_weight = $reject_weight;
    }

    /**
     * @return mixed
     */
    public function getHeadNoonday(): mixed
    {
        return $this->head_noonday;
    }

    /**
     * @param ?string $head_noonday
     * @return void
     */
    public function setHeadNoonday(?string $head_noonday): void
    {
        $this->head_noonday = $head_noonday;
    }

    /**
     * @return mixed
     */
    public function getHeadShiftName(): mixed
    {
        return $this->head_shift_name;
    }

    /**
     * @param ?string $head_shift_name
     * @return void
     */
    public function setHeadShiftName(?string $head_shift_name): void
    {
        $this->head_shift_name = $head_shift_name;
    }
}
