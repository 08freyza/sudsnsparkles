@extends('layout.main')

@push('link')
@endpush

@section('content')
<div class="container">

    <section id="dashboard" class="pt-4 pb-5">
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
                <div class="row mb-4">
                    <div class="col-lg-3 col-sm-6 col-12 mb-lg-0 mb-sm-4 mb-2">
                        <div class="card border border-0 bg-special-red w-100">
                            <div class="card-body text-white">
                                <p class="card-text m-0 fs-16 mb-1">Total Order</p>
                                <h4 class="card-title mb-0 text-end">{{ $num_getorderdone }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 mb-lg-0 mb-sm-4 mb-2">
                        <div class="card border border-0 bg-special-green w-100">
                            <div class="card-body">
                                <p class="card-text m-0 fs-16 mb-1">Total Expense</p>
                                <h4 class="card-title mb-0 text-end">{{ 'Rp. ' . number_format($total_getorderdone, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 mb-lg-0 mb-sm-0 mb-2">
                        <div class="card border border-0 bg-special-yellow w-100">
                            <div class="card-body">
                                <p class="card-text m-0 fs-16 mb-1">Total Order Cancel</p>
                                <h4 class="card-title mb-0 text-end">{{ $getordercancel }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 mb-lg-0 mb-sm-0 mb-2">
                        <div class="card border border-0 bg-special-primary w-100">
                            <div class="card-body text-white">
                                <p class="card-text m-0 fs-16 mb-1">Order to Get Discount</p>
                                <h4 class="card-title mb-0 text-end">{{ $num_getorderdone_user }}/5</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-body text-center">
                        <h4 class="fs-20 fw-medium mb-3 text-start">Latest Order</h4>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center d-md-table-cell d-none">Cust. Name</th>
                                    <th class="text-center d-md-table-cell d-none">Order Date</th>
                                    <th class="text-center d-md-table-cell d-none">Use Pickup</th>
                                    <th class="text-center d-md-table-cell d-none">Use Delivery</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                @forelse ($order as $eachOrder)
                                    <tr class="align-middle">
                                        <td>{{ $eachOrder->order_id }}</td>
                                        <td class="d-md-table-cell d-none">{{ $eachOrder->cust_name }}</td>
                                        <td class="d-md-table-cell d-none">{{ date('d-m-Y H:i:s', strtotime($eachOrder->order_date)) . ' WIB' }}</td>
                                        <td class="d-md-table-cell d-none">{{ $eachOrder->use_pickup == 'Y' ? 'Yes' : 'No' }}</td>
                                        <td class="d-md-table-cell d-none">{{ $eachOrder->use_delivery == 'Y' ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <span class="badge text-bg-{{ $getGivenData['button_color'][$eachOrder->status] }} fs-14">
                                                {{ Str::title(Str::replace('_', ' ', $eachOrder->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="align-middle">
                                        <td colspan="6">Sorry, no matching records found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <a class="btn btn-primary px-3" href="{{ url('order') }}">See More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
@endpush
