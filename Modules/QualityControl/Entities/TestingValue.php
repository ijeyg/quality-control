<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestingValue extends Model
{
    protected $table = 'quality_control_testing_values';

    protected $fillable = [
        'parent_id',
        'machine_id',
        'product_id',
        'time',
        'water',
        'oil',
    ];

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     * @return void
     */
    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     * @return void
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return int
     */
    public function getMachineId(): int
    {
        return $this->machine_id;
    }

    /**
     * @param int $machine_id
     * @return void
     */
    public function setMachineId(int $machine_id): void
    {
        $this->machine_id = $machine_id;
    }


    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return void
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return float|null
     */
    public function getWater(): ?float
    {
        return $this->water;
    }

    /**
     * @param float|null $water
     * @return void
     */
    public function setWater(?float $water): void
    {
        $this->water = $water;
    }

    /**
     * @return float|null
     */
    public function getOil(): ?float
    {
        return $this->oil;
    }

    /**
     * @param float|null $oil
     * @return void
     */
    public function setOil(?float $oil): void
    {
        $this->oil = $oil;
    }
}
