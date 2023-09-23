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
                                href="{{ url((session('username') == 'admin' ? 'admin' : '') . '/' . explode(' ', strtolower($title))[1] . '-category') }}"
                            >
                                {{ explode(' ', $title)[1] }} Category
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ url('admin/service-category/' . $serviceCategories['service_cat_id']) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="mb-2 pb-1">
                        <label for="name" class="fw-medium fs-17">Name</label>
                        <input type="text" class="form-control px-3 py-2 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ old('name') ?? $serviceCategories['name'] }}">
                        @error('name')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="last_number" class="fw-medium fs-17">Last Numbering</label>
                        <input type="text" class="form-control px-3 py-2" id="last_number" name="last_number" placeholder="Your last number" value="{{ old('last_number') ?? $serviceCategories['last_number'] }}" disabled>
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="additional_info" class="fw-medium fs-17">Additional Information</label>
                        <textarea class="form-control" id="additional_info" name="additional_info" placeholder="Your additional information" rows="4">{{ old('additional_info') ?? $serviceCategories['additional_info'] }}</textarea>
                    </div>
                    <div class="my-2 pb-1">
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2 my-1">{{ $title }}</button>
                        <a class="btn btn-outline-danger w-100 py-2 mt-1 mb-1" href="{{ url('admin/service-category') }}">Cancel</a>
                    </div>
                </div>
                <div class="col-4 d-lg-block d-none">
                    <div class="position-relative">
                        <img class="z-3 position-absolute top-0 end-0 mt-5 me-5 rounded-3 border" src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" alt="main-image" width="225" height="315">
                        <div class="z-2 position-absolute p-5 top-0 end-0 ms-5 rounded-3 border border-2" style="width: 225px; height: 315px;"><span>z-2</span></div>
                    </div>
                </div>
            </div>

        </form>
    </section>

</div>
@endsection

@push('script')
@endpush
