<?php

namespace App\Http\Controllers\Customer;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
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
}
