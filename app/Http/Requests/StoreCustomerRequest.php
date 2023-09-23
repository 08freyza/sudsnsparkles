<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
        return [
            'name' => 'required',
            'gender' => 'required',
            'username' => 'required|unique:customers,username',
            'email' => 'email|unique:customers,email',
            'address' => '',
            'phone_number' => 'numeric',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
