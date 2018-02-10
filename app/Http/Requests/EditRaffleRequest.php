<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRaffleRequest extends FormRequest
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
            'brand' => 'required',
            'title' => 'required',
            'max_tickets' => 'required|numeric',
            'type' => 'required',
            'description' => 'required'
        ];
    }
}
