<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseConfirm extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'required|max:255',
            'payment' => 'required|in:1, 2, 3',
        ];
    }

    public function attributes()
    {
        return [
            'address' => 'お届け先住所',
            'payment' => 'お支払い方法',
        ];
    }
}
