<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Average extends Model
{
    protected $table = 'quality_control_average_products';

    protected $fillable = [
        'period',
        'shift',
        'time',
        'design',
        'average',
        'created_at'
    ];

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(AverageValue::class, "parent_id", "id");
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
     * @param mixed $period
     */
    public function setPeriod($period): void
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
    public function setShift($shift): void
    {
        $this->shift = $shift;
    }

    /**
     * @param string|null $design
     * @return void
     */
    public function setDesign(?string $design): void
    {
        $this->design = $design;
    }

    /**
     * @return string|null
     */
    public function getDesign(): ?string
    {
        return $this->design;
    }

    /**
     * @return string|null
     */
    public function getAverage(): ?string
    {
        return $this->average;
    }

    /**
     * @param string|null $average
     */
    public function setAverage(?string $average): void
    {
        $this->average = $average;
    }

    /**
     * @return string|null
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @param string|null $time
     */
    public function setTime(?string $time): void
    {
        $this->time = $time;
    }


}
