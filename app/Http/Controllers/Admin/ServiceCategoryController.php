<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getServiceCategory = ServiceCategory::orderBy('service_cat_id', 'asc')->get();

        $data = [
            'title' => 'Service Category',
            'serviceCategories' => $getServiceCategory
        ];

        return view('services.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.category.create', ['title' => 'Create Service Category']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceCategoryRequest $request)
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lastServiceCatID = ServiceCategory::orderBy('service_cat_id', 'desc')->first();
        $getIndexFromAlpha = strpos($alphabet, $lastServiceCatID['service_cat_id']);
        $produceNewServiceCatID = intval($getIndexFromAlpha) + 1;

        if ($lastServiceCatID) {
            if (ServiceCategory::create(array_merge($request->validated(), ['service_cat_id' => $alphabet[$produceNewServiceCatID], 'last_number' => 0]))) {
                return redirect('admin/service-category')->with('message', 'serviceCategoryCreateSuccess');
            }
        }

        return redirect()->to('admin/service-category')->with('message', 'serviceCategoryCreateFailed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($service_cat_id)
    {
        $getServiceCategory = ServiceCategory::where('service_cat_id', $service_cat_id)->first();

        $data = [
            'title' => 'Edit Service Category',
            'serviceCategories' => $getServiceCategory
        ];

        return view('services.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceCategoryRequest  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceCategoryRequest $request, $service_cat_id)
    {
        if (ServiceCategory::where('service_cat_id', $service_cat_id)->update($request->validated())) {
            return redirect('admin/service-category')->with('message', 'serviceCategoryUpdateSuccess');
        }

        return redirect()->to('admin/service-category')->with('message', 'serviceCategoryUpdateFailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_cat_id)
    {
        if (Service::where('service_cat_id', $service_cat_id)->doesntExist()) {
            if (ServiceCategory::where('service_cat_id', $service_cat_id)->delete()) {
                return response()->json(['success' => 'deleteSuccess']);
            }
        }

        return response()->json(['failed' => 'deleteFailed']);
    }
}
