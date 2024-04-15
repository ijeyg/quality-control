<?php

namespace Modules\QualityControl\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\QualityControl\Entities\Product;
use Modules\QualityControl\Http\Requests\Product\CreateProductRequest;
use Modules\QualityControl\Services\Product\CreateProductService;
use Modules\QualityControl\Services\Product\DeleteProductService;
use Modules\QualityControl\Services\Product\IndexProductService;
use Modules\QualityControl\Services\Product\SingleProductService;
use Modules\QualityControl\Services\Product\UpdateProductService;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @param IndexProductService $indexProductService
     * @return Renderable
     */
    public function index(IndexProductService $indexProductService, Request $request): Renderable
    {
        $products = $indexProductService->handle($request);
        return view('qualitycontrol::panel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('qualitycontrol::panel.products.create');
    }

    /**
     * @param CreateProductRequest $productRequest
     * @param CreateProductService $createProductService
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $productRequest, CreateProductService $createProductService): RedirectResponse
    {
        return $createProductService->handle($productRequest->getDto());
    }

    /**
     * Show the form for editing the specified resource.
     * @param SingleProductService $singleProductService
     * @param Product $product
     * @return Renderable
     */
    public function edit(SingleProductService $singleProductService, Product $product): Renderable
    {
        $product = $singleProductService->handle($product);
        return view('qualitycontrol::panel.products.edit', compact('product'));
    }

    /**
     * @param CreateProductRequest $productRequest
     * @param UpdateProductService $updateProductService
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(CreateProductRequest $productRequest, UpdateProductService $updateProductService, Product $product): RedirectResponse
    {
        return $updateProductService->handle($productRequest->getDto(), $product);
    }

    /**
     * @param DeleteProductService $deleteProductService
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(DeleteProductService $deleteProductService, Product $product): RedirectResponse
    {
        return $deleteProductService->handle($product);
    }
}
