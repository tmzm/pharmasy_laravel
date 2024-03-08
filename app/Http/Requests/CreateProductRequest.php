<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Enums\ReturnMessages;
use App\Http\Controllers\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
{
    use ApiResponse;
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
            'scientific_name' => 'required|min:5|max:50',
            'commercial_name' => 'required|min:5|max:50',
            'company_name' => 'required|min:5|max:50',
            'is_quantity' => 'required',
            'quantity' => 'required',
            'description' => 'required|min:10',
            'price' => 'required',
            'expiration' => 'required|date',
            'image' => ['image','mimes:jpg,jpeg,png,svg'],
            'categories' => ['array','required']
        ];
    }
}
