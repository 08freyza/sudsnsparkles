@extends('layout.main')

@push('link')
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
                        <li class="breadcrumb-item">
                            <a
                                class="text-decoration-none"
                                href="{{ url((session('username') == 'admin' ? 'admin' : '') . '/' . explode(' ', strtolower($title))[1]) }}"
                            >
                                {{ explode(' ', $title)[1] }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $order['order_id'] }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="my-2 pb-1">
                    <label for="order_no" class="fw-medium fs-18">Order No.</label>
                    <p class="m-0">{{ $order['order_id'] }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="order_date" class="fw-medium fs-18">Order Date</label>
                    <p class="m-0">{{ date('d-m-Y H:i:s', strtotime($order['order_date'])) . ' WIB' }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="cust_name" class="fw-medium fs-18">Customer Name</label>
                    <p class="m-0">{{ $order['cust_name'] }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="cust_address" class="fw-medium fs-18">Address</label>
                    <p class="m-0">{{ $order['cust_address'] ?? '-' }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="serv_name" class="fw-medium fs-18">Service Name</label>
                    @foreach ($orderDetail as $eachOrderDetail)
                        <p class="m-0">{{ $eachOrderDetail->serv_name . ' - ' . 'Rp. ' . number_format($eachOrderDetail->serv_price, 0, ',', '.') . '/' . $eachOrderDetail->serv_unit }}</p>
                    @endforeach
                </div>
                <div class="my-2 pb-1">
                    <label for="quantity" class="fw-medium fs-18">Quantity</label>
                    @foreach ($orderDetail as $eachOrderDetail)
                        <p class="m-0">{{ $eachOrderDetail->quantity . ' ' . $eachOrderDetail->serv_unit }}</p>
                    @endforeach
                </div>
                <div class="my-2 pb-1">
                    <label for="use_pickup" class="fw-medium fs-18">Use Pickup?</label>
                    <p class="m-0">{{ $order['use_pickup'] == 'Y' ? 'Yes' : 'No' }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="pickup_date" class="fw-medium fs-18">Picked Up Date</label>
                    <p class="m-0">{{ $order['pickup_date'] != '' ? date('d-m-Y H:i:s', strtotime($order['pickup_date'])) . ' WIB' : '-' }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="use_delivery" class="fw-medium fs-18">Use Delivery?</label>
                    <p class="m-0">{{ $order['use_delivery'] == 'Y' ? 'Yes' : 'No' }}</p>
                </div>
                <div class="my-2 pb-1">
                    <label for="delivery_date" class="fw-medium fs-18">Delivery Date</label>
                    <p class="m-0">{{ $order['delivery_date'] != '' ? date('d-m-Y H:i:s', strtotime($order['delivery_date'])) . ' WIB' : '-' }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="h-25 text-end">
                    <h2 class="fs-18 w-75 mt-2 btn btn-{{ $getGivenData['button_color'][$order['status']] }} rounded rounded-3">{{ Str::title(Str::replace('_', ' ', $order['status'])) }}</h2>
                    <div class="mt-2 mb-1 pb-1">
                        <label for="pay_method" class="fw-medium fs-18">Payment Method</label>
                        <p class="m-0">{{ Str::title(Str::replace('_', ' ', $order['pay_method'])) ?? '-' }}</p>
                    </div>
                </div>
                <div class="h-75 text-end d-flex flex-column justify-content-end">
                    <div class="my-1">
                        <label for="subtotal" class="fw-medium fs-18">Total</label>
                        <p class="m-0 fs-24 fw-semibold">{{ 'Rp. ' . number_format($order['subtotal'], 0, ',', '.') }}</p>
                    </div>
                    <div class="my-1">
                        <label for="shipping_fee" class="fw-medium fs-18">Shipping Fee</label>
                        <p class="m-0 fs-24 fw-semibold">{{ 'Rp. ' . number_format($order['shipping_fee'], 0, ',', '.') }}</p>
                    </div>
                    <div class="my-1">
                        <label for="discount" class="fw-medium fs-18">Discount</label>
                        <p class="m-0 fs-24 fw-semibold">{{'Rp. ' . number_format($order['discount'], 0, ',', '.') }}</p>
                    </div>
                    <div class="my-1">
                        <label for="total" class="fw-medium fs-18">Net Total</label>
                        <p class="m-0 fs-24 fw-semibold">{{ 'Rp. ' . number_format($order['total'], 0, ',', '.') }}</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
@endpush
