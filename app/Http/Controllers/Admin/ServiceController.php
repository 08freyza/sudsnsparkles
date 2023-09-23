<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getService = Service::join('service_categories', 'services.service_cat_id', '=', 'service_categories.service_cat_id')
            ->select('services.*', 'service_categories.name AS service_cat_name')
            ->orderBy('services.service_id', 'asc')
            ->get();

        $data = [
            'title' => 'Service',
            'services' => $getService
        ];

        return view('services.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getServiceCategory = ServiceCategory::all();

        $data = [
            'title' => 'Create Service',
            'serviceCategories' => $getServiceCategory
        ];

        return view('services.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $getData = $request->validated();

        // Make Service ID
        $findProperData = ServiceCategory::select('service_cat_id', 'last_number')->where('service_cat_id', $getData['service_cat_id'])->first();
        $incrementNumber = (intval($findProperData['last_number']) + 1);
        $formatNumber = sprintf('%03s', $incrementNumber);
        $makeServiceId = $findProperData['service_cat_id'] . strval($formatNumber);
        $passServiceId = ['service_id' => $makeServiceId];

        if (ServiceCategory::where('service_cat_id', $getData['service_cat_id'])->update(['last_number' => $incrementNumber])) {
            if (Service::create(array_merge($passServiceId, $getData))) {
                return redirect('admin/service')->with('message', 'serviceCreateSuccess');
            }

            ServiceCategory::where('service_cat_id', $getData['service_cat_id'])->update(['last_number' => $findProperData['last_number']]);
        }

        return redirect()->to('admin/service')->with('message', 'serviceCreateFailed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function detail(Service $service)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        $getService = Service::where('service_id', $service_id)->first();
        $getServiceCategory = ServiceCategory::all();

        $data = [
            'title' => 'Edit Service',
            'service' => $getService,
            'serviceCategories' => $getServiceCategory
        ];

        return view('services.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $service_id)
    {
        if (Service::where('service_id', $service_id)->update($request->validated())) {
            return redirect('admin/service')->with('message', 'serviceCreateSuccess');
        }

        return redirect()->to('admin/service')->with('message', 'serviceCreateFailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id)
    {
        if (Service::where('service_id', $service_id)->delete()) {
            return response()->json(['success' => 'deleteSuccess']);
        }

        return response()->json(['failed' => 'deleteFailed']);
    }
}
