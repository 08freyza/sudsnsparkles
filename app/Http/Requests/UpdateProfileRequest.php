<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $username = session('username');
        $email = $this->get('email');
        if (Auth::guard('admin')->check() == true) {
            $getData = Admin::where('username', $username)->first();
        } else {
            $getData = Customer::where('username', $username)->first();
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'numeric',
        ];

        if ($email == $getData['email']) {
            $rules['email'] = 'required|email';
        }

        if ($this->get('phone_number') == "") {
            $rules['phone_number'] = '';
        }

        return $rules;
    }

    public function getValidatedData()
    {
        return $this->except(['id', '_token', '_method']);
    }
}
