<?php

namespace School\Parents\Http\Requests;

use App\Http\Requests\Request;

class ParentEditRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        // Basic Property Validation
        $rules = [
            'first_name' => 'required|max:255',
        ];

        $TeacherId = $this->route('parents');

        if ($TeacherId) {
            $rules['email'] = 'required|email|max:255|unique:users,email,'.$TeacherId;
        }

        return $rules;
    }

}
