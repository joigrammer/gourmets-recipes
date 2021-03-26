<?php

namespace App\Http\Requests;

use App\Models\Ration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RationStoreRequest extends FormRequest
{
    protected $ration;

    public function __construct(Request $request)
    {
        $this->ration = Ration::find($request->get('ration'));
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
            'rations' => 'required|integer|min:1|max:'.$this->ration->available(),
        ];
    }
}
