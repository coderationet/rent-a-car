<?php

namespace App\Http\Requests\Front\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemCalendarIndexGetRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date_start' => 'required|date|date_format:Y-m-d',
            'date_end' => 'required|date|date_format:Y-m-d',
            'item_id' => 'required|integer|exists:items,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'status_code' => 422,
            'message' => __('validation.error_message'),
            'data' => [],
            'errors' => $errors,
        ]));
    }
}
