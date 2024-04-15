<?php

namespace Modules\QualityControl\Repository\Testing;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Testing\TestingInterface;
use Modules\QualityControl\Traits\QueryTrait;

class TestingRepository implements TestingInterface
{
    use QueryTrait;

    public function getQuery(): Builder
    {
        return $this->TestingQuery();
    }
    /**
     * @param $id
     * @return Builder|Model|mixed|object|null
     */
    public function getById($id): mixed
    {
        return $this->TestingQuery()->where('id', '=', $id)->first();
    }

    /**
     * @param int $id
     * @return Builder
     */
    public function getValues(int $id): Builder
    {
        return $this->TestingQuery()->where('id', '=', $id)->with('values')->first();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->TestingQuery()->get();
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id): int
    {
        return $this->TestingQuery()->where('id', '=', $id)->update($request);
    }

    /**
     * @param $values
     * @param $id
     * @return Builder|Model|int
     */
    public function updateValues($values, $id): Model|Builder|int
    {
        foreach ($values as $key => $value) {
            $this->TestingValueQuery()->updateOrCreate(
                [
                    'parent_id' => $id,
                    'machine_id' => $value['machine_id'],
                    'product_id' => $value['product_id'],
                    'time' => $value['time'],
                ],
                [
                    'water' => $value['water'],
                    'oil' => $value['oil'],
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
        return $this->TestingQuery()->where('id', '=', $id)->delete();
    }

}
