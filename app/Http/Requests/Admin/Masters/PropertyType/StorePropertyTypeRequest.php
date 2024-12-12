<?php

namespace App\Http\Requests\Admin\Masters\PropertyType;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_type_name' => 'required|unique:property_types,property_type_name',
            'initial' => 'required',
        ];
    }
}
