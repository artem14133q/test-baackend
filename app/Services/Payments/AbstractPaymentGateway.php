<?php

namespace App\Services\Payments;

use App\Enums\PaymentGatewayType;
use Illuminate\Http\Request;

interface AbstractPaymentGateway
{
    public function create(array $data): void;

    public function validateSign(Request $request, string $key): bool;

    public function getType(): PaymentGatewayType;
}
