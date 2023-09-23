<?php

use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Printing\PDFController;
use App\Http\Controllers\Test\MapsTestingController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ServiceCategoryController as AdminServiceCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Customer\ServiceController as CustomerServiceController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
HOME SIDE
*/

Route::get('', [HomeController::class, 'index'])->name('home');

/*
GUEST SIDE
*/

Route::group(['middleware' => 'guest'], function () {
    Route::controller(AuthController::class)->group(function () {
        // login
        Route::get('login', 'login')->name('login');
        Route::post('login-action', 'loginAction');

        // registration
        Route::get('registration', 'registration');
        Route::post('registration-action', 'registrationAction');

        // forgot password
        Route::get('forgot', 'forgot');
        Route::post('forgot-action', 'forgotAction');

        // reset password
        Route::get('reset-password/{token}', 'resetPassword');
        Route::post('reset-password-action', 'resetPasswordAction');

        // logout
        Route::get('logout', 'logout');
    });
});

/*
ADMIN SIDE
*/

Route::group(['middleware' => ['auth:admin']], function () {
    Route::prefix('admin')->group(function () {
        // dashboard
        Route::get('', [AdminDashboardController::class, 'index']);

        // customer
        Route::resource('customer', AdminCustomerController::class);

        // service category
        Route::resource('service-category', AdminServiceCategoryController::class);

        // service
        Route::resource('service', AdminServiceController::class);

        // order
        Route::resource('order', AdminOrderController::class);
        Route::prefix('order')->group(function () {
            Route::controller(AdminOrderController::class)->group(function () {
                Route::get('get-customer/{id}', 'getInfoCustomer');
                Route::post('cancel/{id}', 'cancel');
            });
        });

        // profile
        Route::prefix('profile')->group(function () {
            Route::controller(AdminProfileController::class)->group(function () {
                Route::get('', 'index');
                Route::get('edit', 'show');
                Route::post('update', 'update');
                Route::get('edit-address', 'address');
                Route::post('edit-address-process', 'editAddress');
                Route::get('change-password', 'password');
                Route::post('change-password-process', 'editPassword');
                Route::post('upload-image/{id}', 'changePhoto');
            });
        });

        // history
        Route::prefix('history')->group(function () {
            Route::controller(AdminOrderController::class)->group(function () {
                Route::get('', 'history');
                Route::get('{id}', 'showHistory');
            });
        });

        // test maps
        Route::get('maps', [MapsTestingController::class, 'index']);
    });
});

/*
CUSTOMER SIDE
*/

Route::group(['middleware' => ['auth:customer']], function () {
    // dashboard
    Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    // service
    Route::get('service', [CustomerServiceController::class, 'index']);

    // order
    Route::resource('order', CustomerOrderController::class);
    Route::prefix('order')->group(function () {
        Route::controller(CustomerOrderController::class)->group(function () {
            Route::get('get-customer/{id}', 'getInfoCustomer');
            Route::post('cancel/{id}', 'cancel');
        });
    });

    // profile
    Route::prefix('profile')->group(function () {
        Route::controller(CustomerProfileController::class)->group(function () {
            Route::get('', 'index');
            Route::get('edit', 'show');
            Route::post('update', 'update');
            Route::get('edit-address', 'address');
            Route::post('edit-address-process', 'editAddress');
            Route::get('change-password', 'password');
            Route::post('change-password-process', 'editPassword');
            Route::post('upload-image/{id}', 'changePhoto');
            Route::delete('delete/{id}', 'destroy');
        });
    });
});


/*
TESTING SIDE
*/

// Route::get('/test-mail', function () {
//     Notification::route('mail', 'freyzafk08@gmail.com')->notify(new NewMessage());
//     return 'Sent';
// });
Route::get('pdf-test', function () {
    return view('test.home');
});
Route::post('pdf-test/create', [PDFController::class, 'test']);
