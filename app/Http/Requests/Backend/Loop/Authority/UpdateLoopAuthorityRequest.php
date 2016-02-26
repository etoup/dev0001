<?php

namespace App\Http\Requests\Backend\Loop\Authority;

use App\Http\Requests\Request;

/**
 * Class StoreLoopAuthorityRequest
 * @package App\Http\Requests\Backend\Loop
 */
class UpdateLoopAuthorityRequest extends Request
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
            'types' => 'required',
            'title' => 'required',
            'path'   => 'required',
            'sort'  => 'integer'
        ];
    }
}
