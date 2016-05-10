<?php

namespace School\Students\Http\Requests;

use App\Http\Requests\Request;

class StudentCreateRequest extends Request {

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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'studentClass' => 'required',
        ];

        return $rules;
    }

}
