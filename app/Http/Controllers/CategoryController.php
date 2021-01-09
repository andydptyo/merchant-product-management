<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use Illuminate\Support\Facades\DB;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        if ($categories->isEmpty()) {
            return response()->json([], 204);
        }

        $search = request()->search;

        $categories = Category::where('name', 'like', '%'.$search.'%');

        return (new CategoryCollection($categories->paginate()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $category = Category::create($request->all());

            DB::commit();

            return (new CategoryResource($category))
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
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();

        try {
            $category->update($request->all());

            DB::commit();

            return (new CategoryResource($category))
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
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {
            $category->delete();

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
