<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        if ($products->isEmpty()) {
            return response()->json([], 204);
        }

        $search = request()->search;

        $products = Product::with(['categories'])
        ->where(function ($product) use ($search) {
            $product->whereHas('categories', function ($category) use ($search) {
                $category->where('name', 'like', '%'.$search.'%');
            })
            ->orWhere('name', 'like', '%'.$search.'%');
        });

        return (new ProductCollection($products->paginate()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $product = Product::create($request->all());

            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }

            DB::commit();

            return (new ProductResource($product))
                ->response()
                ->setStatusCode(201);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Error on request.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return (new ProductResource($product->loadMissing('categories')))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $product->update($request->all());

            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }

            DB::commit();

            return (new ProductResource($product))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Error on request.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            $product->delete();

            DB::commit();

            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Error on request.'
            ], 500);
        }
    }
}
