<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\V1\IndexFormRequest;
use App\Http\Requests\Api\V1\StoreByCsvFormRequest;
use App\Services\V1\ProductService;

use App\Http\Resources\Api\V1\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexFormRequest $request, ProductService $service)
    {
        $products = $service->index($request->validated());

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeByCsv(StoreByCsvFormRequest $request, ProductService $service)
    {
        $productsCsvFile = $request->file('productsCsv');
        $products = $service->storeByCsv($productsCsvFile);

        return $products;
        // return ProductResource::collection($products);
    }
}
