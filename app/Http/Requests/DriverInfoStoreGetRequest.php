<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverInfoStoreGetRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'day_of_birth' => 'required',
            'identity_number' => 'required',
            'item_id' => 'required|integer|exists:items,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'enable_billing' => 'required',
            'billing_type' => 'required_if:enable_billing,1',
            'payment_option' => 'required',
            // individual_billing_country will be required if enable_billing is 1 and billing_type is individual both at the same time
            // https://laravel.com/docs/10.x/validation#rule-required-if
            'individual_billing_country' => 'required_id,enable_billing,1,billing_type,individual',
//            'individual_billing_country' => Rule::requiredIf(function () {
//                return request()->enable_billing == 1 && request()->billing_type == 'individual';
//            }),
            'individual_billing_city' => 'required_if:enable_billing,1,billing_type,individual',
            'individual_billing_district' => 'required_if:enable_billing,1,billing_type,individual',
            'individual_billing_address' => 'required_if:enable_billing,1,billing_type,individual',
            'company_name' => 'required_if:enable_billing,1,billing_type,company',
            'tax_number' => 'required_if:enable_billing,1,billing_type,company',
            'company_billing_country' => 'required_if:enable_billing,1,billing_type,company',
            'company_billing_city' => 'required_if:enable_billing,1,billing_type,company',
            'company_billing_district' => 'required_if:enable_billing,1,billing_type,company',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->flash('errors', $validator->errors());

        return redirect()->back()->withInput();
    }
}
