<?php

namespace basuregami\UserModule\Http\Request\User;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreRoleRequest.
 */
class UpdatePasswordRequest extends Request
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
        $this->checkOldPassword();
    
        return [
            'old_password'     => 'required|max:255',
            'password' => 'required|min:2|confirmed',
        ];
    }

    public function checkOldPassword()
    {

        $input = $this->all();
        return $input;

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.minimum' => 'Minimum Password Lenght is 2'
        ];
    }
}
