<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverInfoStepGetRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'item_id' => 'required',
            'daterange' => 'required|regex:/^(\d{4}-\d{2}-\d{2})\s\-\s(\d{4}-\d{2}-\d{2})$/',
        ];
    }

    public function response(){
        // errors
        return redirect()->back()->withErrors($this->validator->errors())->withInput();
    }
}
