<?php

namespace Modules\QualityControl\Repository\UnitInspection;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;
use Modules\QualityControl\Contracts\UnitInspection\UnitInspectionInterface;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Services\Strategies\SumCalculationStrategy;
use Modules\QualityControl\Traits\QueryTrait;

class UnitInspectionRepository implements UnitInspectionInterface
{
    use QueryTrait;

    public function __construct(private SumCalculationStrategy $calculationStrategy)
    {
        //
    }

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->UnitInspectionQuery();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed
    {
        return $this->UnitInspectionQuery()->where('id', '=', $id)->first();
    }

    /**
     * @param int $id
     * @return Builder
     */
    public function getValues(int $id): Builder
    {
        return $this->UnitInspectionQuery()->where('id', '=', $id)->with('values')->first();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->UnitInspectionQuery()->get();
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id): int
    {
        return $this->UnitInspectionQuery()->where('id', '=', $id)->update($request);
    }

    /**
     * @param $values
     * @param $id
     * @return Builder|Model|int
     */
    public function updateValues($values, $id): Model|Builder|int
    {
        foreach ($values as $key => $value) {
            $this->UnitInspectionValueQuery()->updateOrCreate(
                ['id' => $key],
                [
                    'parent_id' => $id,
                    'product_id' => $value['product_id'],
                    'machine_id' => $value['machine_id'],
                    'count' => $value['count'],
                    'status_packaging' => $value['status_packaging'],
                    'water' => $value['water'],
                    'oil' => $value['oil'],
                    'pollution' => $value['pollution'],
                    'membrane' => $value['membrane'],
                    'rupture' => $value['rupture'],
                    'humidity' => $value['humidity'],
                    'burn' => $value['burn'],
                    'wrinkles' => $value['wrinkles'],
                    'weight' => $value['weight'],
                    'total' => $this->calculationStrategy->calculate($value),
                ]);
        }
        return true;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->UnitInspectionQuery()->where('id', '=', $id)->delete();
    }

}
