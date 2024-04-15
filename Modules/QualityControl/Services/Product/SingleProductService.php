<?php

namespace Modules\QualityControl\Services\Product;

use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Entities\Product;
use Modules\QualityControl\Transformers\Product\ProductResource;

class SingleProductService
{
    public function __construct(private ?ProductInterface $productRepository)
    {
        //
    }

    /**
     * @param Product $product
     */
    public function handle(Product $product): mixed
    {
        return (new ProductResource($this->productRepository->getById($product['id'])))->resource;
    }
}
