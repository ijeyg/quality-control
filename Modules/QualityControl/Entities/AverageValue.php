<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;

class AverageValue extends Model
{
    protected $table = 'quality_control_average_product_values';

    protected $fillable = [
        'product_id',
        'machine_id',
        'parent_id',
        'design',
        'average',
    ];

    /**
     * @return mixed
     */
    public function getProductId(): mixed
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
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
     * @param int $machineId
     * @return void
     */
    public function setMachineId(int $machineId): void
    {
        $this->machine_id = $machineId;
    }

    /**
     * @return mixed
     */
    public function getParentId(): mixed
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getAverage(): mixed
    {
        return $this->average;
    }

    /**
     * @param mixed $average
     */
    public function setAverage($average): void
    {
        $this->average = $average;
    }


    /**
     * @return mixed
     */
    public function getDesign(): mixed
    {
        return $this->design;
    }

    /**
     * @param mixed $run_weight
     */
    public function setDesign($design): void
    {
        $this->design = $design;
    }
}
