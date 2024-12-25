<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatusGateway1;
use App\Enums\PaymentStatusGateway2;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CallbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(
            request()->has('merchant_id') ? [
                'merchant_id' => ['required', 'integer'],
                'payment_id' => ['required', 'integer'],
                'sign' => ['required', 'string'],
                'timestamp' => ['required', 'integer'],
                'status' => ['required', new Enum(PaymentStatusGateway1::class)],
            ] :  [
                'project' => ['required', 'integer'],
                'invoice' => ['required', 'integer'],
                'rand' => ['required', 'string'],
                'status' => ['required', new Enum(PaymentStatusGateway2::class)],
            ],
            [
                'amount' => ['required', 'integer', 'min:1'],
                'amount_paid' => ['required', 'integer', 'min:1'],
            ]
        );
    }
}
