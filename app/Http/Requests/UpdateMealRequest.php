<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMealRequest extends FormRequest
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
            'outer-group.*.name' => ['required',
                Rule::unique('meals', 'name')->ignore($this->mid)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'outer-group.*.name.required' => 'Product name is required.',
            'outer-group.*.name.unique' => 'Product name is already exist.',
            //'outer-group.*.inner-group.*.images_path.required' => 'At least 1 image is requiredddd.'
            //'name.max' => 'Meal name may not be greater than 100 characters.',
            //'description.max' => 'Meal description may not be greater than 5000 characters.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'outer-group.*.name' => 'Product Name',
            //'outer-group.*.inner-group.*.images_path' => 'Image'
            //'Description' => 'Meal Description',
        ];
    }
}
