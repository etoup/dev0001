<?php

namespace App\Http\Requests\Backend\Od;

use App\Http\Requests\Request;

/**
 * Class StoreLoopRequest
 * @package App\Http\Requests\Backend\Od
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
            'status' => 'required'
        ];
    }
}
