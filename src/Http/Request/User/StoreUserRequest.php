<?php

namespace basuregami\UserModule\Http\Request\User;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest.
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
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|min:2|confirmed',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
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
            'password.required'  => 'A password is required',
            'password.min' => 'Password must have minimum 4 character'
        ];
    }



    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
//    public function withValidator($validator)
//    {
//        $validator->after(function ($validator) {
//            if ($validator->fails()) {
//               dd('error');
//            }
//        });
//    }
}
