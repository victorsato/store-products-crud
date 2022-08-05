<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        switch($this->method()) {
            case 'PUT':
                $rules = [
                    'name' => 'required|min:3|max:40',
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('stores', 'email')->ignore($this->id)
                    ]
                ];
                break;
            default:
                $rules = [
                    'name' => 'required|min:3|max:40',
                    'email' => 'required|email|unique:stores,email'
                ];
        }

        return $rules;
    }

}
