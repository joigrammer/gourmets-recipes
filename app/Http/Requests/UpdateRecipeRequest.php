<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateRecipeRequest extends FormRequest
{
    public function __construct(Request $request)
    {   
        $request['user_id'] = backpack_user()->id;     
        $request['slug'] = $request['slug'] ? Str::slug($request['slug']) : Str::slug($request['name']);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
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
                Rule::unique('recipes')->ignore($this->id)
            ],
            'slug' => [
                'required', 'min:5', 'max:70',
                Rule::unique('recipes')->ignore($this->id)
            ],
            'meal_id' => 'required|exists:meals,id',
            'extract' => 'required|min:5|max:155',
            'body' => 'required', 
            'tags.*' => 'exists:tags,id',  
            'image' => [
                'required_without:id', 'mimes:jpg,png'
            ],
            'ingredients'      => function ($attribute, $value, $fail) {
                $fieldGroups = json_decode($value);
                if (count($fieldGroups) == 0) {
                    return $fail('The simple field group must have at least one item.');
                }
                foreach ($fieldGroups as $key => $group) {
                    $fieldGroupValidator = Validator::make((array) $group, [
                        'amount'  => 'required|integer',
                        'measurement_id' => 'required|exists:measurements,id',
                        'annotation' => '',
                        'ingredient_id' => 'required|exists:ingredients,id'
                    ]);

                    if ($fieldGroupValidator->fails()) {
                        return $fail($fieldGroupValidator->errors()->first());
                    }
                }
            },
        ];
    }
}
