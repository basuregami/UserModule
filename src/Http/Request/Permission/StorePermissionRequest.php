<?php

namespace basuregami\UserModule\Http\Request\Permission;

use basuregami\UserModule\Http\Request\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreRoleRequest.
 */
class StorePermissionRequest extends Request
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
            'display_name'     => 'required|max:255',
            'description'    => 'max:255',
        
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['display_name'] = filter_var($input['display_name'], FILTER_SANITIZE_STRING);
        $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);
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
            'display_name.required' => 'Display name is required',
            'description.max' => 'Maximum Description length is 255 character',
           
        ];
    }



}
