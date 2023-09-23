@extends('layout.main')

@push('link')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="{{ asset('assets/js/ship-fee-gmaps.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order') }}" method="POST">
            @csrf

            <input type="hidden" name="filled_by" value="{{ session('username') }}">
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="d-none" id="geturl" data-url="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order') }}"></div>
                    <div class="mb-2 pb-1">
                        <label for="customer_id" class="fw-medium fs-17">Customer Name</label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                            <option value="" {{ old('customer_id') == '' ? 'selected' : '' }} disabled>Choose Customer...</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->id . ' - ' . $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-12">
                    <div class="mb-2 pb-1">
                        <label for="use_pickup" class="fw-medium fs-17">Use Pickup</label>
                        <select class="form-select @error('use_pickup') is-invalid @enderror" id="use_pickup" name="use_pickup" {{ old('use_pickup') == $customer->use_pickup ? 'disabled="disabled"' : '' }}>
                            <option value="" selected disabled>Choose Option...</option>
                            @foreach (['Y', 'N'] as $usePickup)
                                <option value="{{ $usePickup }}">
                                    {{ Str::title($usePickup) }}
                                </option>
                            @endforeach
                        </select>
                        @error('use_pickup')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-12">
                    <div class="mb-2 pb-1">
                        <label for="use_delivery" class="fw-medium fs-17">Use Delivery</label>
                        <select class="form-select @error('use_delivery') is-invalid @enderror" id="use_delivery" name="use_delivery" {{ old('use_delivery') == $customer->use_delivery ? 'disabled="disabled"' : '' }}>
                            <option value="" selected disabled>Choose Option...</option>
                            @foreach (['Y', 'N'] as $useDelivery)
                                <option value="{{ $useDelivery }}">
                                    {{ Str::title($useDelivery) }}
                                </option>
                            @endforeach
                        </select>
                        @error('use_delivery')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-12">
                    <div class="mb-2 pb-1">
                        <label for="pay_method" class="fw-medium fs-17">Payment Method</label>
                        <select class="form-select @error('pay_method') is-invalid @enderror" id="pay_method" name="pay_method">
                            <option value="" {{ old('pay_method') == '' ? 'selected' : '' }} disabled>Choose Option...</option>
                            @foreach (['cash', 'non_cash'] as $payMethod)
                                <option value="{{ $payMethod }}" {{ old('pay_method') == $payMethod ? 'selected' : '' }}>
                                    {{ Str::title(Str::replace('_', ' ', $payMethod)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('pay_method')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="fw-medium fs-17">The Orders</div>
                    <button type="button" class="btn btn-primary mb-2 px-4" id="add-row">Add Row</button>
                    <button type="button" class="btn btn-outline-danger mb-2 px-4" id="remove-row" disabled="disabled">Remove</button>
                    <div class="the-order border rounded mb-2 overflow-auto" id="the-orders">
                        <div class="row m-2" id="row-orders">
                            <div class="col-sm-6 col-9">
                                <div class="mb-2 pb-1">
                                    <label for="service_id[]" class="fw-medium fs-17">Service Name</label>
                                    <select class="form-select" id="service_id1" name="service_id[]" onchange="serviceShowDefaultVal('1')">
                                        <option value="" selected disabled>Choose Service...</option>
                                        @foreach ($services as $service)
                                            <option data-price="{{ $service->price }}" value="{{ $service->service_id }}">
                                                {{ $service->service_id . ' - ' . $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <div class="mb-2 pb-1">
                                    <label for="quantity[]" class="fw-medium fs-17">Quantity</label>
                                    <input type="number" class="form-control" id="quantity1" name="quantity[]" onblur="quantityShowPriceVal('1')" placeholder="Your quantity" value="0">
                                </div>
                            </div>
                            <div class="col-3 d-sm-block d-none">
                                <div class="mb-2 pb-1">
                                    <label for="subtotal[]" class="fw-medium fs-17">Subtotal</label>
                                    <input type="number" class="form-control" id="subtotal1" name="subtotal[]" onblur="sumSubtotal()" placeholder="Your subtotal" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-2 pb-1">
                        <label for="subtotal_order" class="fw-medium fs-17">Subtotal Order</label>
                        <input type="number" class="form-control px-3 py-2 @error('subtotal_order') is-invalid @enderror" id="subtotal_order" name="subtotal_order" placeholder="Your subtotal order" value="0" readonly>
                        @error('subtotal_order')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="shipping_fee" class="fw-medium fs-17">Shipping Fee</label>
                        <input type="number" class="form-control px-3 py-2 @error('shipping_fee') is-invalid @enderror" id="shipping_fee" name="shipping_fee" placeholder="Your shipping fee" value="0" readonly>
                        @error('shipping_fee')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" id="length" value="{{ $length }}">
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="discount" class="fw-medium fs-17">Discount</label>
                        <input type="number" class="form-control px-3 py-2 @error('discount') is-invalid @enderror" id="discount" name="discount" onblur="sumSubtotal()" placeholder="Your discount" value="0" {{ Auth::guard('admin')->check() == true ? '' : 'readonly' }}>
                        @error('discount')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (Auth::guard('customer')->check() == true && intval($length) % 5 == 0)
                            <p class="m-0 pt-2 text-secondary fs-14">Wow, looks like you get a 25% discount.
                        @endif
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="total" class="fw-medium fs-17">Total</label>
                        <input type="number" class="form-control px-3 py-2 @error('total') is-invalid @enderror" id="total" name="total" placeholder="Your total" value="0" readonly>
                        @error('total')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-4 mb-2 pb-1">
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2 my-1">{{ $title }}</button>
                        <a class="btn btn-outline-danger w-100 py-2 mt-1 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/order') }}">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="d-none" id="map"></div>
                <div class="d-none" id="sidebar">
                    <h3 style="flex-grow: 0">Request</h3>
                    <pre style="flex-grow: 1" id="request"></pre>
                    <h3 style="flex-grow: 0">Response</h3>
                    <pre style="flex-grow: 1" id="response"></pre>
                </div>
            </div>

        </form>
    </section>

</div>
@endsection

@push('script')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuN63dkeBKLJH8vS5hjLt8zRUHo9Ye3kw&callback=initMap&v=weekly">
</script>
<script src="{{ asset('assets/js/order/order-page.js') }}"></script>
@endpush
