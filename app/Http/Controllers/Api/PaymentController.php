<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallbackRequest;
use App\Services\Payments\AbstractPaymentGateway;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * @param CallbackRequest $request
     * @param AbstractPaymentGateway $paymentGateway
     * @return JsonResponse
     */
    public function paymentCallback(CallbackRequest $request, AbstractPaymentGateway $paymentGateway)
    {
        $paymentGateway->create($request->validated());

        return response()->json(['message' => 'success']);
    }
}
