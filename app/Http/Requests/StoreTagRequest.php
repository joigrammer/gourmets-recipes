<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreTagRequest extends FormRequest
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
                'required', 'unique:tags,name', 'min:3', 'max:32'
            ],
            'slug' => [
                'required', 'unique:tags,slug', 'min:3', 'max:32'
            ]
        ];
    }
}
