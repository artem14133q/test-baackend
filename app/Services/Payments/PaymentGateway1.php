<?php

namespace App\Services\Payments;

use App\Enums\PaymentGatewayType;
use App\Enums\PaymentStatusGateway1;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentGateway1 implements AbstractPaymentGateway
{
    /**
     * @throws Exception
     */
    public function create(array $data): void
    {
        Payment::query()->updateOrCreate([
            "merchant_id" => $data['merchant_id'],
            "payment_id" => $data['payment_id'],
        ], [
            "status" => PaymentStatusGateway1::from($data['status'])->preparedStatus()->value,
            "amount" => $data['amount'],
            "amount_paid" => $data['amount_paid'],
        ]);
    }

    public function validateSign(Request $request, string $key): bool
    {
        $sign = hash('sha256', collect($request->except('sign'))->sortKeys()->implode(':') . $key);

        if ($sign != $request->input('sign')) {
            return false;
        }

        return true;
    }

    public function getType(): PaymentGatewayType
    {
        return PaymentGatewayType::GATEWAY1;
    }
}
