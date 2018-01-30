<?php

namespace basuregami\UserModule\Http\Request\User;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreRoleRequest.
 */
class ProfileUserRequest extends Request
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
       // $input = $this->all());
        return [
            'name'     => 'required|max:255',
            'address' => 'required'
            //'email' => 'unique:users,email,'.$this->input['id']
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['address'] = filter_var($input['address'], FILTER_SANITIZE_STRING);
        //$input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
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
            'name.required' => 'User name is required',
            'address.required' => 'Address is required',
        ];
    }
}
