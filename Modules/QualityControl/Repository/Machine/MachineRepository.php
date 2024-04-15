<?php

namespace Modules\QualityControl\Repository\Machine;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Machine\MachineInterface;
use Modules\QualityControl\Traits\QueryTrait;

class MachineRepository implements MachineInterface
{
    use QueryTrait;

    /**
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): object|null
    {
        return $this->MachineQuery()->where('id', "=", $id)->first();
    }

    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return $this->MachineQuery()->get();
    }

    /**
     * @param array $requests
     * @return Model|Builder
     */
    public function create(array $requests): Model|Builder
    {
        return $this->MachineQuery()->create($requests);
    }

    /**
     * @param array $requests
     * @param int $id
     * @return int
     */
    public function update(array $requests, int $id): int
    {
        return $this->MachineQuery()->where('id', '=', $id)->update($requests);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->MachineQuery()->where('id', '=', $id)->delete();
    }
}
