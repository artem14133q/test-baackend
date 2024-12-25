<?php

namespace App\Services\Payments;

use App\Enums\PaymentGatewayType;
use App\Enums\PaymentStatusGateway2;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentGateway2 implements AbstractPaymentGateway
{
    /**
     * @throws Exception
     */
    public function create(array $data): void
    {
        Payment::query()->updateOrCreate([
            "merchant_id" => $data['project'],
            "payment_id" => $data['invoice'],
        ], [
            "status" => PaymentStatusGateway2::from($data['status'])->preparedStatus()->value,
            "amount" => $data['amount'],
            "amount_paid" => $data['amount_paid'],
        ]);
    }

    public function validateSign(Request $request, string $key): bool
    {
        $sign = hash('md5', collect($request->all())->sortKeys()->implode('.') . $key);

        if ($sign != $request->header('Authorization')) {
            return false;
        }

        return true;
    }

    public function getType(): PaymentGatewayType
    {
        return PaymentGatewayType::GATEWAY2;
    }
}
