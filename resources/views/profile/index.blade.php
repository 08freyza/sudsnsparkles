@extends('layout.main')

@push('link')
@endpush

@section('content')
<div class="container mb-2">

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


        <div class="row gx-1">
            <div class="col-lg-8 col-12 d-flex justify-content-md-none justify-content-center">
                <div id="change-frame-photo" class="image-group text-center">
                    <div class="border border-0 d-sm-block d-none" style="height: 324.4px; width: 324.4px;">
                        <img id="image-frame" class="w-100 h-100 rounded" src="{{ $profile['image'] == null ? asset('assets/img/blank.jpg') : asset('storage/images/profile/' . $profile['image']) }}" alt="profile picture">
                    </div>
                    <div class="border border-0 d-sm-none d-block w-100">
                        <img id="image-frame-2" class="w-100 h-100 rounded" src="{{ $profile['image'] == null ? asset('assets/img/blank.jpg') : asset('storage/images/profile/' . $profile['image']) }}" alt="profile picture">
                    </div>
                    <div class="d-flex flex-column">
                        <button class="btn btn-primary px-sm-5 px-auto py-2 mt-2 my-0" id="button-uploader">Change Image</button>
                        <form class="" id="form-upload" action="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/upload-image/' . $profile['username']) }}" method="POST"  enctype="multipart/form-data">
                            @csrf

                            <input name="media_file" type="file" id="media_file" accept="image/*" capture="camera" hidden />
                            <button id="change-profile-image" data-id="{{ $profile['username'] }}" data-url="{{ url()->full() }}" class="btn btn-success px-5 py-2 mt-1 mb-0 d-none w-100">Save Now</button>
                        </form>
                    </div>
                </div>
                <div class="ms-5 w-100 d-md-block d-none">
                    <div class="my-2 pb-1">
                        <label for="name" class="fw-medium fs-17">Name</label>
                        <p class="m-0">{{ $profile['name'] ?? '-' }}</p>
                    </div>
                    <div class="my-2 pb-1">
                        <label for="username" class="fw-medium fs-17">Username</label>
                        <p class="m-0">{{ $profile['username'] ?? '-' }}</p>
                    </div>
                    <div class="my-2 pb-1">
                        <label for="email" class="fw-medium fs-17">Email</label>
                        <p class="m-0">{{ $profile['email'] ?? '-' }}</p>
                    </div>
                    <div class="my-2 pb-1">
                        <label for="phone_number" class="fw-medium fs-17">Phone Number</label>
                        <p class="m-0">{{ $profile['phone_number'] ?? '-' }}</p>
                    </div>
                    <div class="my-2 pb-1">
                        <label for="created_at" class="fw-medium fs-17">Created At</label>
                        <p class="m-0">{{ date("d F Y H:i:s", strtotime($profile['created_at'])) ?? '-' }}</p>
                    </div>
                    <div class="mt-4 d-lg-none d-flex align-items-baseline" style="padding-top: 1px;">
                        <a class="btn btn-secondary w-50 py-2 mt-0 me-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/change-password') }}">Edit Password</a>
                        <a class="btn btn-secondary w-50 py-2 mt-0 ms-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit') }}">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-12 d-md-none d-block pt-md-0 pt-4">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="d-sm-block d-none">
                                <div class="my-2 pb-1">
                                    <label for="name" class="fw-medium fs-17">Name</label>
                                    <p class="m-0">{{ $profile['name'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 pb-1">
                                    <label for="username" class="fw-medium fs-17">Username</label>
                                    <p class="m-0">{{ $profile['username'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 pb-1">
                                    <label for="email" class="fw-medium fs-17">Email</label>
                                    <p class="m-0">{{ $profile['email'] ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="border rounded d-sm-none d-block">
                                <div class="my-2 mx-3 pb-1">
                                    <label for="name" class="fw-medium fs-17">Name</label>
                                    <p class="m-0">{{ $profile['name'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 mx-3 pb-1">
                                    <label for="username" class="fw-medium fs-17">Username</label>
                                    <p class="m-0">{{ $profile['username'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 mx-3 pb-1">
                                    <label for="email" class="fw-medium fs-17">Email</label>
                                    <p class="m-0">{{ $profile['email'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 mx-3 pb-1 d-sm-none d-block">
                                    <label for="phone_number" class="fw-medium fs-17">Phone Number</label>
                                    <p class="m-0">{{ $profile['phone_number'] ?? '-' }}</p>
                                </div>
                                <div class="my-2 mx-3 pb-1 d-sm-none d-block">
                                    <label for="created_at" class="fw-medium fs-17">Created At</label>
                                    <p class="m-0">{{ date("d F Y H:i:s", strtotime($profile['created_at'])) ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 d-sm-block d-none">
                            <div class="my-2 pb-1">
                                <label for="phone_number" class="fw-medium fs-17">Phone Number</label>
                                <p class="m-0">{{ $profile['phone_number'] ?? '-' }}</p>
                            </div>
                            <div class="my-2 pb-1">
                                <label for="created_at" class="fw-medium fs-17">Created At</label>
                                <p class="m-0">{{ date("d F Y H:i:s", strtotime($profile['created_at'])) ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-md-4 mt-2 d-lg-none d-flex align-items-baseline" style="padding-top: 1px;">
                        <a class="btn btn-secondary w-50 py-2 mt-0 me-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/change-password') }}">Edit Password</a>
                        <a class="btn btn-secondary w-50 py-2 mt-0 ms-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit') }}">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 pt-lg-0 pt-4">
                <ul class="list-group d-md-block d-none">
                    <li class="list-group-item bg-light" style="height: 187.1px;">
                        <label for="address" class="fw-medium fs-17">Address</label>
                        <p class="m-0 text-truncate"><span class="text-wrap">{{ $profile['address'] ?? '-' }}</span></p>
                    </li>
                </ul>
                <ul class="list-group d-md-none d-block">
                    <li class="list-group-item bg-light">
                        <label for="address" class="fw-medium fs-17">Address</label>
                        <p class="m-0 text-truncate"><span class="text-wrap">{{ $profile['address'] ?? '-' }}</span></p>
                    </li>
                </ul>
                <div class="text-center">
                    <a class="btn btn-primary w-100 py-2 mt-2 me-2 mb-xl-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit-address') }}">Change Address</a>
                    <div class="change-data d-xl-flex d-none">
                        <a class="btn btn-secondary w-50 py-2 mt-5 me-1 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/change-password') }}">Change Password</a>
                        <a class="btn btn-secondary w-50 py-2 mt-5 ms-1 my-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit') }}">Change Profile</a>
                    </div>
                    <div class="change-data d-xl-none d-lg-flex d-none">
                        <a class="btn btn-secondary w-100 py-2 mt-xl-5 mt-2 me-xl-2 me-0 mb-xl-1 mb-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/change-password') }}">Change Password</a>
                    </div>
                    <div class="change-data d-xl-none d-lg-flex d-none">
                        <a class="btn btn-secondary w-100 py-2 mt-xl-5 mt-2 ms-xl-2 ms-0 my-xl-1 my-0" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit') }}">Change Profile</a>
                    </div>
                    <form class="mt-lg-0 mt-5" id="delete-form-data" action="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/delete/' . $profile['username']) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button id="delete-data" class="btn btn-outline-danger w-100 px-5 py-2 mt-xl-1 mt-lg-2 mt-0 my-1">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
<script src="{{ asset('assets/js/ajax-upload-image.js') }}"></script>
<script>
    $('#media_file').imageUploadResizer({
        max_width: 325, // Defaults 1000
        max_height: 325, // Defaults 1000
        quality: 1, // Defaults 1
        do_not_resize: ['gif', 'svg'], // Defaults []
    });

    function openDialog() {
        $('#media_file').click();
    }

    $('#button-uploader').click(openDialog);

    $('#media_file').change(function() {
        // submit the form
        $('#change-profile-image').removeClass('d-none');
    });

    //Resize window
    function resize() {
        if ($(window).width() < 559) {
            $('#change-frame-photo').addClass('w-100');
        } else {
            $('#change-frame-photo').removeClass('w-100');
        }
    }

    //watch window resize
    $(window).on('resize', function() {
        resize()
    });
</script>
<script src="{{ asset('assets/js/ajax-del-profile.js') }}"></script>
@endpush
