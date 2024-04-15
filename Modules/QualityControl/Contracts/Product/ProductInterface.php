<?php

namespace Modules\QualityControl\Contracts\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProductInterface
{

    /**
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): object|null;

    /**
     * @return Collection|array
     */
    public function all(): Collection|array;

    /**
     * @param array $requests
     * @return Model|Builder
     */
    public function create(array $requests): Model|Builder;

    /**
     * @param array $requests
     * @param int $id
     * @return int
     */
    public function update(array $requests, int $id): int;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;
}
