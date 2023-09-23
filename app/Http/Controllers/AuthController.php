<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use App\Notifications\ResetPasswordRequest;
use Exception;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return Auth::guard('admin')->check()
            || Auth::guard('customer')->check()
            ? redirect()->route('home')
            : view('auth.login', ['title' => 'Login']);
    }

    public function loginAction(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (
            auth()->guard('customer')->attempt($credentials, $request->getRemember())
            || auth()->guard('admin')->attempt($credentials, $request->getRemember())
        ) {
            $user = auth()->user();
            $usernameOrEmail = isset($credentials['username']) ? $credentials['username'] : $credentials['email'];

            if ($usernameOrEmail == 'admin' || $usernameOrEmail == 'admin@sudsnsparkle.com') {
                $getData = Admin::where(array_search($usernameOrEmail, $credentials), $usernameOrEmail)->first();
            } else {
                $getData = Customer::where(array_search($usernameOrEmail, $credentials), $usernameOrEmail)->first();
            }

            session([
                'username' => $getData['username'],
                'email' => $getData['email'],
            ]);

            return $this->authenticated($request, $user);
        }

        return redirect()->to('login')->with('message', 'signInNotValid');
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended()->with('message', 'signInSuccess');
    }

    public function registration()
    {
        return Auth::guard('admin')->check()
            || Auth::guard('customer')->check()
            ? redirect()->route('home')
            : view('auth.registration', ['title' => 'Registration']);
    }

    public function registrationAction(RegisterRequest $request)
    {
        $user = Customer::create($request->validated());

        return $user ? redirect('login')->with('message', 'registrationSuccess')
            : redirect()->to('registration');
    }

    public function forgot()
    {
        return Auth::guard('admin')->check()
            || Auth::guard('customer')->check()
            ? redirect()->route('home')
            : view('auth.forgot', ['title' => 'Forgot Password']);
    }

    public function forgotAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);

        $getData = [
            'email' => $request->email,
            'token' => Str::random(64),
            'created_at' => Carbon::now()
        ];

        if (DB::table('password_resets')->insert($getData)) {
            try {
                Notification::route('mail', $getData['email'])->notify(new ResetPasswordRequest($getData['token']));
            } catch (Exception $e) {
                DB::table('password_resets')->where('email', $getData['email'])->delete();

                return redirect('forgot')->with('message', 'emailInvalid');
            }

            return redirect('login')->with('message', 'sendEmailForgotPasswordSuccessful');
        }

        return redirect('forgot')->with('message', 'sendEmailForgotPasswordFailed');
    }

    public function resetPassword($token)
    {
        if (Auth::guard('admin')->check() || Auth::guard('customer')->check()) {
            return redirect()->route('home');
        }

        $getData = DB::table('password_resets')->where('token', $token)->first();

        if (!$getData) {
            return redirect('');
        }

        $data = [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => $getData->email
        ];

        return view('auth.reset', $data);
    }

    public function resetPasswordAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $getData = $request->only(['email', 'token']);
        $getPass = $request->only(['password']);

        $getDataFromDatabase = DB::table('password_resets')->where($getData)->first();

        if ($getDataFromDatabase) {
            if (Customer::where('email', $getData['email'])->update(['password' => Hash::make($getPass['password'])])) {
                DB::table('password_resets')->where('email', $getData['email'])->delete();

                return redirect('login')->with('message', 'passwordChangeSuccessful');
            }

            return back()->withInput()->with('message', 'passwordChangeFailed');
        }

        return back()->withInput()->with('message', 'tokenInvalid');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check() == true) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('customer')->check() == true) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('');
    }
}
