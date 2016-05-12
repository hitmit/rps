<?php

namespace School\Newsboard\Http\Requests;

use App\Http\Requests\Request;

class CreateNewsBoardRequest extends Request
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
            'newsTitle' => 'required',
            'newsText' => 'required',
            'newsFor' => 'required',
            'newsDate' => 'required'
        ];
    }
}
