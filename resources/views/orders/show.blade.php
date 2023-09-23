@extends('layout.main')

@push('link')
@if ($order['status'] == 'unpaid' && $order['pay_method'] == 'non_cash')
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endif
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

                    @if ($order['status'] != 'cancelled' && $order['status'] != 'done')
                        <div class="my-1 pb-1 w-100">
                            <div class="mb-2">

                                @if ($order['status'] == 'unpaid')
                                    @if ($order['pay_method'] != 'non_cash')
                                        @if (Auth::guard('admin')->check() == true)
                                            <button class="btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                {{ Str::title(Str::replace('_', ' ', $getGivenData['button_text'][$order['status']])) }}
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ url('admin/order/' . $order['order_id']) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <input type="hidden" name="pay_method" value="{{ $order['pay_method'] }}">
                                                            <input type="hidden" name="total" value="{{ $order['total'] }}">
                                                            <input type="hidden" name="status" value="{{ $order['status'] }}">
                                                            <input type="hidden" name="use_pickup" value="{{ $order['use_pickup'] }}">
                                                            <input type="hidden" name="use_delivery" value="{{ $order['use_delivery'] }}">

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cash Payment</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="number" class="form-control px-3 py-2" id="payment_cash" name="payment_cash" placeholder="Your payment" value="0">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Proceed Now!</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <button class="btn btn-success w-75" id="pay-button">
                                            {{ Str::title(Str::replace('_', ' ', $getGivenData['button_text'][$order['status']])) }}
                                        </button>
                                    @endif
                                @else
                                    @if (Auth::guard('admin')->check() == true)
                                        <form action="{{ url('admin/order/' . $order['order_id']) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="pay_method" value="{{ $order['pay_method'] }}">
                                            <input type="hidden" name="status" value="{{ $order['status'] }}">
                                            <input type="hidden" name="use_pickup" value="{{ $order['use_pickup'] }}">
                                            <input type="hidden" name="use_delivery" value="{{ $order['use_delivery'] }}">

                                            <button class="btn btn-success w-75">
                                                {{ Str::title(Str::replace('_', ' ', $getGivenData['button_text'][$order['status']])) }}
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>


                            @if ($order['status'] == 'wait_confirmation' || ($order['status'] == 'in_progress' && $order['use_pickup'] != 'Y'))
                                <form id="form-cancel" action="{{ url('admin/order/cancel/' . $order['order_id']) }}" method="POST">
                                    @csrf

                                    <div class="mb-2">
                                        <button class="btn btn-outline-danger w-75" id="cancel-order" data-id="{{ $order['order_id'] }}">Cancel Order</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
@if ($order['status'] == 'unpaid' && $order['pay_method'] == 'non_cash')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function (e) {
            e.preventDefault();
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    Swal.fire({
                        title: "Payment Success!",
                        text: "Thank you for paying your order.",
                        icon: "success",
                    }).then(result => {
                        window.location.href = "{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order/' . $order['order_id']) }}"
                    });
                    // console.log(result);
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    Swal.fire({
                        title: "Payment Pending!",
                        text: "Please waiting your payment.",
                        icon: "warning",
                    }).then(result => {
                        window.location.href = "{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order/' . $order['order_id']) }}"
                    });
                    // console.log(result);
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    Swal.fire({
                        title: "Payment Failed!",
                        text: "Unfortunately, your payment is failed.",
                        icon: "error",
                    }).then(result => {
                        window.location.href = "{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order/' . $order['order_id']) }}"
                    });
                    // console.log(result);
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    Swal.fire({
                        title: "Pop up Closed!",
                        text: "You closed the popup without finishing the payment.",
                        icon: "warning",
                    });
                }
            })
        });
    </script>
@elseif ($order['status'] == 'wait_confirmation' || ($order['status'] == 'in_progress' && $order['use_pickup'] != 'Y'))
    <script src="{{ asset('assets/js/ajax-cancel-order.js') }}"></script>
@endif
@endpush
