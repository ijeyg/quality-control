<?php

namespace Modules\QualityControl\Repository\Reject;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Reject\RejectInterface;
use Modules\QualityControl\Contracts\Strategies\CalculationStrategyInterface;
use Modules\QualityControl\Services\Strategies\SumCalculationStrategy;
use Modules\QualityControl\Traits\QueryTrait;

class RejectRepository implements RejectInterface
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
        return $this->RejectQuery();
    }

    /**
     * @param $id
     * @return Builder|Model|mixed|object|null
     */
    public function getById($id): mixed
    {
        return $this->RejectQuery()->where('id', '=', $id)->first();
    }

    /**
     * @param int $id
     * @return Builder
     */
    public function getValues(int $id): Builder
    {
        return $this->RejectQuery()->where('id', '=', $id)->with('values')->first();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->RejectQuery()->get();
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id): int
    {
        return $this->RejectQuery()->where('id', '=', $id)->update($request);
    }

    /**
     * @param $values
     * @param $id
     * @return Builder|Model|int
     */
    public function updateValues($values, $id): Model|Builder|int
    {
        foreach ($values as $key => $value) {
            $this->RejectValueQuery()->updateOrCreate(
                ['id' => $key],
                [
                    'parent_id' => $id,
                    'product_id' => $value['product_id'],
                    'machine_id' => $value['machine_id'],
                    'run_weight' => $value['run_weight'],
                    'technical_weight' => $value['technical_weight'],
                    'accept_weight' => $value['accept_weight'],
                    'quality_weight' => $value['quality_weight'],
                    'line_weight' => $value['line_weight'],
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
        return $this->RejectQuery()->where('id', '=', $id)->delete();
    }

}
