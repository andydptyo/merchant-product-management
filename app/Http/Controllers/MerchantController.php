<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Http\Requests\MerchantRequest;
use App\Http\Resources\MerchantResource;
use App\Http\Resources\MerchantCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::get();

        if ($merchants->isEmpty()) {
            return response()->json([], 204);
        }

        $search = request()->search;

        $merchants = Merchant::where('name', 'like', '%'.$search.'%');

        return (new MerchantCollection($merchants->paginate()))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MerchantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantRequest $request)
    {
        DB::beginTransaction();

        try {
            $merchant = Merchant::create($request->all());

            DB::commit();

            return (new MerchantResource($merchant))
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
     * @param  \App\Models\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        return (new MerchantResource($merchant->loadMissing(['products'])))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MerchantRequest $request
     * @param  \App\Models\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(MerchantRequest $request, Merchant $merchant)
    {
        DB::beginTransaction();

        try {
            $merchant->update($request->all());

            if ($products = $request->products) {
                $merchant->products()->sync($products);
            }

            DB::commit();

            return (new MerchantResource($merchant))
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
     * @param  \App\Models\Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        DB::beginTransaction();

        try {
            $merchant->delete();

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
