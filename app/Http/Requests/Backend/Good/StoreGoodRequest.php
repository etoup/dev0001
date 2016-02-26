<?php

namespace App\Http\Requests\Backend\Good;

use App\Http\Requests\Request;

/**
 * Class StoreLoopRequest
 * @package App\Http\Requests\Backend\Good
 */
class StoreLoopRequest extends Request
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
            'title' => 'required|max:20',
            'profiles' => 'required|max:34',
            'price' => 'required|numeric',
            'numbers' => 'required|integer',
            'stocks' => 'required|integer',
            'remark' => 'max:34',
        ];
    }
}
