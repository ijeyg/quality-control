<?php

namespace Modules\QualityControl\Repository\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Entities\Product;
use Modules\QualityControl\Traits\QueryTrait;

class ProductRepository implements ProductInterface
{
    use QueryTrait;

    /**
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): object|null
    {
        return $this->ProductQuery()->where('id', "=", $id)->first();
    }

    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return $this->ProductQuery()->get();
    }

    /**
     * @param array $requests
     * @return Model|Builder
     */
    public function create(array $requests): Model|Builder
    {
        return $this->ProductQuery()->create($requests);
    }

    /**
     * @param array $requests
     * @param int $id
     * @return int
     */
    public function update(array $requests, int $id): int
    {
        return $this->ProductQuery()->where('id', '=', $id)->update($requests);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->ProductQuery()->where('id', '=', $id)->delete();
    }
}
