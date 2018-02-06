<?php

namespace basuregami\UserModule\Http\Request\User;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

/**
 * Class StoreRoleRequest.
 */
class StoreUserRequest extends Request
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
        $this->sanitize();

        return [
            'name'     => 'required|max:255',
            'address' => 'max:150',
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')],
            'username' => ['required', 'max:20', Rule::unique('users')],
            'password' => 'required|min:2|confirmed',
            'role_id' => 'required'
        ];
    }

    public function sanitize()
    {
      
        $input = $this->all();
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['address'] = filter_var($input['address'], FILTER_SANITIZE_STRING);
        $input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
        $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $input['role_id'] =  Crypt::decrypt($input['role_id']);
        $this->replace($input);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'email.required' => 'A email is required',
            'role_id.required' =>  'Role is required',
            'password.required'  => 'A password is required',
            'password.min' => 'Password must have minimum 4 character'
        ];
    }
}
