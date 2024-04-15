<?php

namespace Modules\QualityControl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testing extends Model
{
    protected $table = 'quality_control_testings';

    protected $fillable = [
        'code',
        'morning',
        'night',
        'period',
        'head',
        'description',
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
     * @return string
     */
    public function getCode(): string
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

    public function getHead(): string
    {
        return $this->head;
    }

    public function setHead(?string $head): void
    {
        $this->head = $head;
    }

    /**
     * @return int
     */
    public function getMorning(): int
    {
        return $this->morning;
    }

    /**
     * @param int $morning
     * @return void
     */
    public function setMorning(int $morning): void
    {
        $this->morning = $morning;
    }

    /**
     * @return int
     */
    public function getNight(): int
    {
        return $this->night;
    }

    /**
     * @param int $night
     * @return void
     */
    public function setNight(int $night): void
    {
        $this->night = $night;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(TestingValue::class, "parent_id", "id");
    }
}
