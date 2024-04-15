<?php

namespace Modules\QualityControl\Contracts\Reject;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RejectInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return Builder
     */
    public function getValues(int $id): Builder;

    /**
     * @param $request
     * @param $id
     * @return int
     */
    public function update($request, $id): int;
    /**
     * @param $values
     * @param $id
     * @return Builder|Model|int
     */
    public function updateValues($values, $id): Model|Builder|int;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;

}
