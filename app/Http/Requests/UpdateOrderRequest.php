<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'name'       => [
                'nullable',
                'max:20',
                'regex:/^([\x7f-\xff]+)$|^([a-zA-Z]+)$/',
            ],
            'map_id'     => [
                'integer',
                'exists:maps,id',
            ],
            'address'    => [
                'regex:/^([\x7f-\xff0-9\-\s]+)$/',
            ],
            'mobile'     => 'regex:/^09[0-9]{2}-[0-9]{3}-[0-9]{3}$/',
            'payment.id' => [
                'nullable',
                'regex: /^([0-9]{5}+)$|^([0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}+)$/',
            ],
            'fee'        => [
                'integer',
                'min:0',
            ],
            'status'     => [
                'in:PENDING,CHECKED,PAID,ARRIVED',
            ],
        ];
    }
}
