<?php

namespace School\StudyMaterial\Http\Requests;

use App\Http\Requests\Request;
use Sentinel;

class CreateStudyMaterialRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Sentinel::check() && Sentinel::inRole('teacher'))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'material_title' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required'
        ];

    }
}
