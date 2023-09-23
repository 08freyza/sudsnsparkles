<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        $id = $this->get('id');
        $email = $this->get('email');
        $getData = Customer::where('id', $id)->first();

        $rules = [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'email|unique:customers,email',
            'address' => '',
            'latitude' => '',
            'longitude' => '',
            'phone_number' => 'numeric',
        ];

        if ($email == $getData['email']) {
            $rules['email'] = 'email';
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
