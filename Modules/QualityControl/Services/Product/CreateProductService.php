<?php

namespace Modules\QualityControl\Services\Product;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\DTO\Product\CreateProductDto;

class CreateProductService
{
    public function __construct(private ?ProductInterface $productRepository)
    {
        //
    }

    /**
     * @param CreateProductDto $productDto
     * @return RedirectResponse
     */
    public function handle(CreateProductDto $productDto): RedirectResponse
    {
        $this->productRepository->create([
            "title" => $productDto->getTitle(),
            "weight" => $productDto->getWeight(),
            "description" => $productDto->getDescription()
        ]);
        return redirect()->back()->with(['message' => 'محصول با موفقیت اضافه شد']);
    }

}
