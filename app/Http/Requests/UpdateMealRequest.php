<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateMealRequest extends FormRequest
{
    public function __construct(Request $request)
    {
        $request['slug'] = $request->get('slug') ? Str::slug($request->get('slug')) : Str::slug($request->get('name')); 
    }

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
            'name' => [
                'required', 'min:5', 'max:70',
                Rule::unique('meals')->ignore($this->id)
            ],
            'slug' => [
                'required', 'min:5', 'max:70',
                Rule::unique('meals')->ignore($this->id)
            ],
            'description' => [
                'max:192'
            ],
            'image' => [
                'required_without:id', 'mimes:svg'
            ]
        ];
    }
}
