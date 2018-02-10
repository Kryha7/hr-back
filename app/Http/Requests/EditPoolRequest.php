<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPoolRequest extends FormRequest
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
            'first_option' => 'required|string',
            'second_option' => 'required|string',
        ];
    }
}
