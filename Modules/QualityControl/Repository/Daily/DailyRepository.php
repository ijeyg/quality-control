<?php

namespace Modules\QualityControl\Repository\Daily;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Daily\DailyInterface;
use Modules\QualityControl\Entities\Daily;
use Modules\QualityControl\Traits\QueryTrait;

class DailyRepository implements DailyInterface
{
    use QueryTrait;

    /**
     * @param $id
     * @return Builder|Model|mixed|object|null
     */
    public function getById($id): mixed
    {
        return $this->DailyQuery()->where('id', '=', $id)->first();
    }

    /**
     * @param int $id
     * @return Builder
     */
    public function getValues(int $id): Builder
    {
        return $this->DailyQuery()->where('id', '=', $id)->with('values')->first();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->DailyQuery()->get();
    }

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id): int
    {
        return $this->DailyQuery()->where('id', '=', $id)->update($request);
    }

    /**
     * @param $values
     * @param $id
     * @return Builder|Model|int
     */
    public function updateValues($values, $id): Model|Builder|int
    {
        foreach ($values as $key => $value) {
            $this->DailyValueQuery()->updateOrCreate(
                ['id' => $key],
                [
                    'parent_id' => $id,
                    'product_id' => $value['product_id'],
                    'machine_id' => $value['machine_id'],
                    'box_numbers' => $value['box_numbers'],
                    'delivery_weight' => $value['delivery_weight'],
                    'accept_weight' => $value['accept_weight'],
                    'reject_weight' => $value['reject_weight'],
                    'description' => $value['description']
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
        return $this->DailyQuery()->where('id', '=', $id)->delete();
    }

}
