<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfileAddressRequest;
use App\Http\Requests\UpdateProfilePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $getProfile = Customer::where('username', session('username'))->first()->toArray();

        $data = [
            'title' => 'Profile',
            'profile' => $getProfile
        ];

        return view('profile.index', $data);
    }

    public function show()
    {
        $getProfile = Customer::where('username', session('username'))->first()->toArray();

        $data = [
            'title' => 'Edit Profile',
            'profile' => $getProfile
        ];

        return view('profile.edit', $data);
    }

    public function update(UpdateProfileRequest $request)
    {
        $getProfile = Customer::where('username', session('username'));

        if ($getProfile->update($request->getValidatedData())) {
            return redirect('profile')->with('message', 'profileUpdateSuccess');
        }

        return redirect()->to('profile/edit')->with('message', 'profileUpdateFailed');
    }

    public function address()
    {
        $getProfile = Customer::select('address', 'latitude', 'longitude')->where('username', session('username'))->first()->toArray();

        $data = [
            'title' => 'Edit Profile Address',
            'profile' => $getProfile
        ];

        return view('profile.maps', $data);
    }

    public function editAddress(UpdateProfileAddressRequest $request)
    {
        $getProfile = CUstomer::where('username', session('username'));

        if ($getProfile->update($request->validated())) {
            return redirect('profile')->with('message', 'addressUpdateSuccess');
        }

        return redirect()->to('profile/edit-address')->with('message', 'addressUpdateFailed');
    }

    public function password()
    {
        $data = [
            'title' => 'Change Profile Password',
        ];

        return view('profile.password', $data);
    }

    public function editPassword(UpdateProfilePasswordRequest $request)
    {
        $getInputVal = $request->only(['old_password', 'password']);

        if (Customer::where('username', session('username'))->update(['password' => Hash::make($getInputVal['password'])])) {
            return redirect('profile')->with('message', 'changePasswordSuccess');
        }

        return redirect('profile')->with('message', 'changePasswordFailed');
    }

    public function changePhoto(Request $request, $id)
    {
        $getUsername = $id;
        $getProfile = Customer::where('username', $getUsername);
        $retrieveOldImage = $getProfile->first()->toArray();

        if ($request->hasFile('media_file')) {
            $filename = $getUsername . time() . '.' . $request->media_file->getClientOriginalExtension();

            if ($request->media_file->move(public_path('storage/images/profile'), $filename)) {
                if (File::exists(public_path('storage/images/profile/' . $retrieveOldImage['image']))) {
                    File::delete(public_path('storage/images/profile/' . $retrieveOldImage['image']));
                } else {
                    return redirect('profile')->with('message', 'OldImageDoesntExist');
                }

                if ($getProfile->update(['image' => $filename])) {
                    return redirect('profile')->with('message', 'uploadAndSaveImageSuccess');
                }
                return redirect('profile')->with('message', 'saveImageFailed');
            }
            return redirect('profile')->with('message', 'uploadImageFailed');
        }

        return redirect('profile')->with('message', 'uploadImageError');
    }

    public function destroy(Request $request, $username)
    {
        if (Auth::guard('admin')->check() == true) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('customer')->check() == true) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (Customer::where('username', $username)->delete()) {
            return redirect('')->with('message', 'AccountDeletedSuccessful');
        }

        return redirect('')->with('message', 'AccountDeletedFailed');
    }
}
