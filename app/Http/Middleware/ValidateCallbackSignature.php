<?php

namespace App\Http\Middleware;

use App\Services\Payments\AbstractPaymentGateway;
use Closure;
use Illuminate\Http\Request;

class ValidateCallbackSignature
{
    public function handle(Request $request, Closure $next)
    {
        $gateway = app(AbstractPaymentGateway::class);

        $key = config("services.payments_gateways.{$gateway->getType()->value}.key");

        if (!$gateway->validateSign($request, $key)) {
            return response()->json(['message' => 'Invalid signature.'], 401);
        }

        return $next($request);
    }
}
