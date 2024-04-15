<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reject extends Model
{
    use SoftDeletes;

    protected $table = 'quality_control_rejects';

    protected $fillable = [
        'code',
        'period',
        'shift',
        'line_weight',
        'run_weight',
        'technical_weight',
        'accept_weight',
        'quality_weight',
        'total',
        'head_shift_name',
        'head_noonday',
        'created_at'
    ];


    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(RejectValue::class, "parent_id", "id");
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
    public function getCode(): mixed
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
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
    public function getHeadShiftName(): mixed
    {
        return $this->head_shift_name;
    }

    /**
     * @param mixed $head_shift_name
     */
    public function setHeadShiftName($head_shift_name): void
    {
        $this->head_shift_name = $head_shift_name;
    }

    /**
     * @return mixed
     */
    public function getHeadNoonday(): mixed
    {
        return $this->head_noonday;
    }

    /**
     * @param mixed $head_noonday
     */
    public function setHeadNoonday($head_noonday): void
    {
        $this->head_noonday = $head_noonday;
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
