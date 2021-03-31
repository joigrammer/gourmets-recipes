<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StoreRecipeRequest extends FormRequest
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
            'name' => 'required|unique:recipes|min:5|max:70',
            'slug' => 'required|unique:recipes|min:5|max:70',
            'meal_id' => 'required|exists:meals,id',
            'extract' => 'required|min:5|max:155',
            'body' => 'required', 
            'tags.*' => 'exists:tags,id',  
            'ingredients'      => function ($attribute, $value, $fail) {
                $fieldGroups = json_decode($value);

                // do not allow repeatable field to be empty
                if (count($fieldGroups) == 0) {
                    return $fail('The simple field group must have at least one item.');
                }

                // ALTERNATIVE:
                // allow repeatable field to be empty
                // if (count($fieldGroups) == 0) {
                //   return true;
                // }

                // SECOND-LEVEL REPEATABLE VALIDATION
                // run through each field group inside the repeatable field
                // and run a custom validation for it
                foreach ($fieldGroups as $key => $group) {
                    $fieldGroupValidator = Validator::make((array) $group, [
                        'amount'  => 'required|integer',
                        'measurement_id' => 'required|exists:measurements,id',
                        'annotation' => '',
                        'ingredient_id' => 'required|exists:ingredients,id'
                    ]);

                    if ($fieldGroupValidator->fails()) {
                        // return $fail('One of the entries in the '.$attribute.' group is invalid.');
                        // alternatively, you could just output the first error
                        return $fail($fieldGroupValidator->errors()->first());
                        // or you could use this to debug the errors
                            // dd($fieldGroupValidator->errors());
                    }
                }
            },
        ];
    }
}
