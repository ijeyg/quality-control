<?php

namespace Modules\QualityControl\Services\Product;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\DTO\Product\CreateProductDto;
use Modules\QualityControl\Entities\Product;

class UpdateProductService
{
    public function __construct(private ?ProductInterface $productRepository)
    {
        //
    }

    /**
     * @param CreateProductDto $productDto
     * @param Product $product
     * @return RedirectResponse
     */
    public function handle(CreateProductDto $productDto, Product $product): RedirectResponse
    {
        $this->productRepository->update(
            [
                'title' => $productDto->getTitle(),
                'weight' => $productDto->getWeight(),
                'description' => $productDto->getDescription()
            ], $product['id']);
        return redirect()->back()->with(['message' => 'محصول با موفقیت بروزرسانی شد']);
    }
}
