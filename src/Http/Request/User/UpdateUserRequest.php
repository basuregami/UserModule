<?php

namespace basuregami\UserModule\Http\Request\User;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreRoleRequest.
 */
class UpdateUserRequest extends Request
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
        if ( ! empty($this->password) ) {
            return [
                'name'     => 'required|max:255',
                'status' => 'required',
                'address' => 'required',
                'password' => 'sometimes|min:2|confirmed',
            ];
        }
        return [
            'name'     => 'required|max:255',
            'status' => 'required',
            'address' => 'required',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['address'] = filter_var($input['address'], FILTER_SANITIZE_STRING);
        

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
            'name.required' => 'Name field is required',
            'address.required' => 'Address field is required',
        ];
    }
}
