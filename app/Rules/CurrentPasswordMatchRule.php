<?php

namespace App\Rules;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class CurrentPasswordMatchRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $getUsername = session('username');
        $getData = Auth::guard('admin')->check() == true
            ? Admin::select('password')->where('username', $getUsername)->first()
            : Customer::select('password')->where('username', $getUsername)->first();

        return Hash::check($value, $getData['password']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your old password is invalid.';
    }
}
