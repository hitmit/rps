<?php

namespace School\GradeLevels\Http\Requests;

use App\Http\Requests\Request;

class CreateGradeLevelsRequest extends Request
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
        return [
            'gradeName' => 'required',
            'gradePoints' => 'required',
            'gradeFrom' => 'required',
            'gradeTo' => 'required'
        ];

    }
}
