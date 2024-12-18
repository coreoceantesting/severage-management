<?php

namespace App\Http\Requests\Admin\NOC;

use Illuminate\Foundation\Http\FormRequest;

class StoreNocRequest extends FormRequest
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
            'application_id' => 'nullable',
            'applicant_name' => 'required',
            'date' => 'required',
            'property_type' => 'required',
            'address_of_applicant' => 'required',
            'address_of_property' => 'required',
            'phone_no' => 'required|digits:10',
            'addhar_no' => 'required|digits:12',
        ];
    }
}
