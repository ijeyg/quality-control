<?php

namespace Modules\QualityControl\Services\Product;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Transformers\Product\ProductResource;

class IndexProductService
{
    public function __construct(private ?ProductInterface $productRepository)
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return ProductResource::collection($this->productRepository->all())->toArray($request);
    }
}
