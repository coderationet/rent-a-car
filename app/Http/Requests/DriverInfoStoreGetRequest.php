<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        ];
    }

    /*
    redirect if any errors accure to the previous page with the errors
    */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->session()->flash('errors', $validator->errors());
        return redirect()->back()->withInput();
    }
}
