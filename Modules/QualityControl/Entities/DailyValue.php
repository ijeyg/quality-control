<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'quality_control_daily_values';

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(Daily::class, "id", "parent_id");
    }

    /**
     * @var string[]
     */
    protected $fillable = ['parent_id','machine_id','box_numbers', 'product_id', 'delivery_weight', 'accept_weight', 'reject_weight','description'];

    /**
     * @return int
     */
    public function getDeliveryWeight(): float
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
     * @return int
     */
    public function getAcceptWeight(): float
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
     * @return int
     */
    public function getRejectWeight(): float
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
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parentId
     * @return void
     */
    public function setParentId(int $parentId): void
    {
        $this->parent_id = $parentId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $productId
     * @return void
     */
    public function setProductId(int $productId): void
    {
        $this->product_id = $productId;
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
     * @param $description
     * @return void
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}
