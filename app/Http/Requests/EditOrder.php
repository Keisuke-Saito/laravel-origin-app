<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditOrder extends FormRequest
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
        $payment_rule = Rule::in(array_keys(Order::PAYMENT));
        $status_rule = Rule::in(array_keys(Order::STATUS));

        return [
            'payment' => 'required|' . $payment_rule,
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        return [
            'payment' => 'お支払い方法',
            'status' => '対応状況',
        ];
    }

    public function messages()
    {
        $payment_labels = array_map(function($item) {
            return $item['label'];
        }, Order::PAYMENT);

        $payment_labels = implode('」、「', $payment_labels);

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Order::STATUS);

        $status_labels = implode('」、「', $status_labels);

        return [
            'payment.in' => ':attributeには「' . $payment_labels. '」のいずれかを指定してください。',
            'status.in' => ':attributeには「' . $status_labels. '」のいずれかを指定してください。',
        ];
    }
}
