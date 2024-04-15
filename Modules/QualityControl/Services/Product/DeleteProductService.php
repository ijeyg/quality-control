<?php

namespace Modules\QualityControl\Services\Product;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Product\ProductInterface;
use Modules\QualityControl\Entities\Product;

class DeleteProductService
{
    public function __construct(private ?ProductInterface $productRepository)
    {
        //
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function handle(Product $product): RedirectResponse
    {
        $this->productRepository->delete($product['id']);
        return redirect()->back()->with(['message' => 'محصول با موفقیت حذف شد']);
    }
}
