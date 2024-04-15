<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitInspectionValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'quality_control_unit_inspection_values';

    /**
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'product_id',
        'machine_id',
        'count',
        'status_packaging',
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
        'total',
    ];

    /**
     * @param $value
     * @return void
     */
    public function setParentId($value): void
    {
        $this->parent_id = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setProductId($value): void
    {
        $this->product_id = $value;
    }

    /**
     * @return int
     */
    public function getMachineId(): int
    {
        return $this->machine_id;
    }

    /**
     * @param int $machineId
     * @return void
     */
    public function setMachineId(int $machineId): void
    {
        $this->machine_id = $machineId;
    }

    /**
     * @param $value
     * @return void
     */
    public function setCount($value): void
    {
        $this->count = $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function setStatusPackaging($value): void
    {
        $this->status_packaging = $value;
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
    public function setTotal($value): void
    {
        $this->total = $value;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

}
