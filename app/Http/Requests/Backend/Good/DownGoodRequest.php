<?php

namespace App\Http\Requests\Backend\Good;

use App\Http\Requests\Request;

/**
 * Class DownGoodRequest
 * @package App\Http\Requests\Backend\Good
 */
class DownGoodRequest extends Request
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
            'id' => 'required',
            'remark' => 'max:34'
        ];
    }
}
