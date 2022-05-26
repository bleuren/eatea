<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name'   => [
                'required',
                'max:20',
                'regex:/^([\x7f-\xff]+)$|^([a-zA-Z]+)$/',
            ],
            'mobile' => 'required|regex:/^09[0-9]{2}-[0-9]{3}-[0-9]{3}$/',
            'map_id' => [
                // 'required',
                'integer',
                'exists:maps,id',
            ],
        ];
    }
}
