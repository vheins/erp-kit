<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationSubDistrict;
use Illuminate\Http\Request;
use App\Http\Requests\Location\SubDistrict\StoreRequest;
use App\Http\Requests\Location\SubDistrict\UpdateRequest;
use App\Actions\Location\SubDistrict\Store;
use App\Actions\Location\SubDistrict\Update;
use App\Actions\Location\SubDistrict\Delete;


class SubDistrictController extends Controller
{
    protected $is_public = true;
    protected $need_permission = true;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = LocationSubDistrict::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\SubDistrict\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = Store::run($request->validated());
        return $this->success($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationSubDistrict  $locationSubDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(LocationSubDistrict $locationSubDistrict)
    {
        //$locationSubDistrict->load();
        return $this->success($locationSubDistrict);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\SubDistrict\UpdateRequest  $request
     * @param  \App\Models\LocationSubDistrict  $locationSubDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationSubDistrict $locationSubDistrict)
    {
        $update = Update::run($locationSubDistrict, $request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationSubDistrict  $locationSubDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationSubDistrict $locationSubDistrict)
    {
        $delete = Delete::run($locationSubDistrict);
        return $this->success($delete);
    }
}