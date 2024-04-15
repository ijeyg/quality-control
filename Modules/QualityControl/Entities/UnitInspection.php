<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitInspection extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'quality_control_unit_inspections';

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'period',
        'shift',
        'place',
        'head_shift_name',
        'head_noonday',
        'water',
        'oil',
        'pollution',
        'membrane',
        'rupture',
        'humidity',
        'burn',
        'wrinkles',
        'weight',
        'number',
        'total_of_total',
        'total',
        'created_at'
    ];

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
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(UnitInspectionValue::class, "parent_id", "id");
    }


    /**
     * @param $value
     * @return void
     */
    public function setCode($value): void
    {
        $this->code = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setPeriod($value): void
    {
        $this->period = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setShift($value): void
    {
        $this->shift = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setPlace($value): void
    {
        $this->place = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setHeadShiftName($value): void
    {
        $this->head_shift_name = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setHeadNoonday($value): void
    {
        $this->head_noonday = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setWater($value): void
    {
        $this->water = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setOil($value): void
    {
        $this->oil = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setPollution($value): void
    {
        $this->pollution = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setMembrane($value): void
    {
        $this->membrane = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setRupture($value): void
    {
        $this->rupture = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setHumidity($value): void
    {
        $this->humidity = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setBurn($value): void
    {
        $this->burn = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setWrinkles($value): void
    {
        $this->wrinkles = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setWeight($value): void
    {
        $this->weight = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setNumber($value): void
    {
        $this->number = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setTotalOfTotal($value): void
    {
        $this->total_of_total = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setTotal($value): void
    {
        $this->total = $value;
    }
}
