<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;

class RejectValue extends Model
{
    protected $table = 'quality_control_reject_values';

    protected $fillable = [
        'product_id',
        'machine_id',
        'parent_id',
        'line_weight',
        'accept_weight',
        'run_weight',
        'technical_weight',
        'quality_weight',
        'total'
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
    public function getAcceptWeight(): mixed
    {
        return $this->accept_weight;
    }

    /**
     * @param mixed $accept_weight
     */
    public function setAcceptWeight($accept_weight): void
    {
        $this->accept_weight = $accept_weight;
    }


    /**
     * @return mixed
     */
    public function getRunWeight(): mixed
    {
        return $this->run_weight;
    }

    /**
     * @param mixed $run_weight
     */
    public function setRunWeight($run_weight): void
    {
        $this->run_weight = $run_weight;
    }

    /**
     * @return mixed
     */
    public function getTechnicalWeight(): mixed
    {
        return $this->technical_weight;
    }

    /**
     * @param mixed $technical_weight
     */
    public function setTechnicalWeight($technical_weight): void
    {
        $this->technical_weight = $technical_weight;
    }

    /**
     * @return mixed
     */
    public function getQualityWeight(): mixed
    {
        return $this->quality_weight;
    }

    /**
     * @param mixed $quality_weight
     */
    public function setQualityWeight($quality_weight): void
    {
        $this->quality_weight = $quality_weight;
    }

    /**
     * @return mixed
     */
    public function getTotal(): mixed
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getLineWeight(): mixed
    {
        return $this->line_weight;
    }

    /**
     * @param mixed $line_weight
     */
    public function setLineWeight($line_weight): void
    {
        $this->line_weight = $line_weight;
    }
}
