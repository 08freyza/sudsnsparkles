<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $getProfile = Admin::where('username', session('username'))->first()->toArray();

        $data = [
            'title' => 'Your Profile',
            'profile' => $getProfile
        ];

        return view('profile.index', $data);
    }

    public function show()
    {
        $getProfile = Admin::where('username', session('username'))->first()->toArray();

        $data = [
            'title' => 'Edit Your Profile',
            'profile' => $getProfile
        ];

        return view('profile.edit', $data);
    }

    public function update(UpdateProfileRequest $request)
    {
        $getProfile = Admin::where('username', session('username'));

        if ($getProfile->update($request->getValidatedData())) {
            return redirect('admin/profile')->with('message', 'profileUpdateSuccess');
        }

        return redirect()->to('admin/profile/edit')->with('message', 'profileUpdateFailed');
    }

    public function address()
    {
        $getProfile = Admin::select('address', 'latitude', 'longitude')->where('username', session('username'))->first();

        $data = [
            'title' => 'Edit Your Address',
            'profile' => $getProfile
        ];

        return view('profile.maps', $data);
    }

    public function editAddress(UpdateProfileAddressRequest $request)
    {
        $getProfile = Admin::where('username', session('username'));

        if ($getProfile->update($request->validated())) {
            return redirect('admin/profile')->with('message', 'addressUpdateSuccess');
        }

        return redirect()->to('admin/profile/edit-address')->with('message', 'addressUpdateFailed');
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

        if (Admin::where('username', session('username'))->update(['password' => Hash::make($getInputVal['password'])])) {
            return redirect('admin/profile')->with('message', 'changePasswordSuccess');
        }

        return redirect('admin/profile')->with('message', 'changePasswordFailed');
    }

    public function changePhoto(Request $request, $id)
    {
        $getUsername = $id;
        $getProfile = Admin::where('username', $getUsername);
        $retrieveOldImage = $getProfile->first()->toArray();

        if ($request->hasFile('media_file')) {
            $filename = $getUsername . time() . '.' . $request->media_file->getClientOriginalExtension();

            if ($request->media_file->move(public_path('storage/images/profile'), $filename)) {
                if (File::exists(public_path('storage/images/profile/' . $retrieveOldImage['image']))) {
                    File::delete(public_path('storage/images/profile/' . $retrieveOldImage['image']));
                } else {
                    return redirect('admin/profile')->with('message', 'OldImageDoesntExist');
                }

                if ($getProfile->update(['image' => $filename])) {
                    return redirect('admin/profile')->with('message', 'uploadAndSaveImageSuccess');
                }
                return redirect('admin/profile')->with('message', 'saveImageFailed');
            }
            return redirect('admin/profile')->with('message', 'uploadImageFailed');
        }

        return redirect('admin/profile')->with('message', 'uploadImageError');
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

        if (Admin::where('username', $username)->delete()) {
            return redirect('')->with('message', 'AccountDeletedSuccessful');
        }

        return redirect('')->with('message', 'AccountDeletedFailed');
    }
}
