<?php

namespace School\Assignments\Http\Requests;

use App\Http\Requests\Request;
use Sentinel;

class CreateAssignmentsRequest   extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Sentinel::check() && (Sentinel::inRole('teacher') || Sentinel::inRole('admin')))
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
            'AssignTitle' => 'required',
            'AssignDeadLine' => 'required',
            'classId' => 'required',
            'subjectId' => 'required'
        ];

    }
}
