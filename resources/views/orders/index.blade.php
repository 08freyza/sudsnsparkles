@extends('layout.main')

@push('link')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
<!-- Choices select -->
<link rel="stylesheet" href="{{ asset('assets/vendor/choices.js/public/assets/styles/choices.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="container">

    <section id="profile" class="pt-4 pb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 text-lg-start text-center">
                <h1 class="fw-semibold fs-40 text-navysky mb-lg-4 mb-1">{{ $title }}</h1>
            </div>
            <div class="col-lg-6 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-lg-end float-none justify-content-lg-none justify-content-center mb-lg-none mb-4">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                <div class="row">
                    <div class="col-lg-5 col-md-4 col-6">
                        @if (session('username') == 'admin')
                            <div class="card-header bg-white border border-0 p-3">
                                <div class="d-flex">
                                    <button class="btn btn-outline-primary dropdown-toggle px-3 me-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-right-to-bracket me-lg-2 me-0"></i>
                                        <span class="d-lg-inline d-none">Export</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">
                                            Export to .xls format
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Export to .pdf format
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-md-8 col-6 ms-auto">
                        <div class="card-header bg-white border border-0 p-3">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary px-3" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') .'/order/create') }}">
                                    <i class="fa-solid fa-plus me-md-2 me-0"></i>
                                    <span class="d-md-inline d-none">Add <span class="d-xl-inline d-none">{{ $title }}</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-1 border-top">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="table1">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center d-md-table-cell d-none">Cust. Name</th>
                                    <th class="text-center d-md-table-cell d-none">Order Date</th>
                                    <th class="text-center d-lg-table-cell d-none">Use Pickup</th>
                                    <th class="text-center d-lg-table-cell d-none">Use Delivery</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center d-md-table-cell d-none">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $eachOrder)
                                    <tr class="align-middle">
                                        <td><span class="d-md-inline d-none">{{ $eachOrder->order_id }}</span><a class="d-md-none d-inline text-decoration-none" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order/' . $eachOrder->order_id) }}">{{ $eachOrder->order_id }}</a></td>
                                        <td class=" d-md-table-cell d-none">{{ $eachOrder->cust_name }}</td>
                                        <td class=" d-md-table-cell d-none">{{ date('d-m-Y H:i:s', strtotime($eachOrder->order_date)) . ' WIB' }}</td>
                                        <td class="d-lg-table-cell d-none">{{ $eachOrder->use_pickup == 'Y' ? 'Yes' : 'No' }}</td>
                                        <td class="d-lg-table-cell d-none">{{ $eachOrder->use_delivery == 'Y' ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $getGivenData['button_color'][$eachOrder->status] }} fs-14 ">
                                                {{ Str::title(Str::replace('_', ' ', $eachOrder->status)) }}
                                            </span>
                                        </td>
                                        <td class="d-md-table-cell d-none">
                                            <a href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order/' . $eachOrder->order_id) }}" class="btn btn-sm btn-primary me-1">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
<!-- Datatables -->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.3/datatables.min.js"></script>
<script src="{{ asset('assets/js/datatables-desc.js') }}"></script>
<!-- Choices select -->
<script src="{{ asset('assets/vendor/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/form-element-select.js') }}"></script>
@endpush
