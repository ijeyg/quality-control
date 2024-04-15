<?php

namespace Modules\QualityControl\Repository\Average;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Average\AverageInterface;
use Modules\QualityControl\Traits\QueryTrait;

class AverageRepository implements AverageInterface
{
    use QueryTrait;

    public function getQuery(): Builder
    {
        return $this->AverageQuery();
    }

    public function getById(int $id): mixed
    {
        return $this->AverageQuery()->where('id', '=', $id)->first();
    }

    public function all(): Collection
    {
        return $this->AverageQuery()->get();
    }

    public function getValues(int $id): Builder
    {
        return $this->AverageQuery()->where('id', '=', $id)->with('values')->first();
    }

    public function update($request, $id): int
    {
        return $this->AverageQuery()->where('id', '=', $id)->update($request);
    }

    public function updateValues($values, $id): Model|Builder|int
    {
        foreach ($values as $key => $value) {
            $this->AverageValueQuery()->updateOrCreate(
                [
                    'parent_id' => $id,
                    'machine_id' => $value['machine_id'],
                    'product_id' => $value['product_id'],
                ],
                [
                    'design' => $value['design'],
                    'average' => $value['average'],
                ]);
        }
        return true;
    }

    public function delete(int $id): mixed
    {
        return $this->AverageQuery()->where('id', '=', $id)->delete();
    }
}
