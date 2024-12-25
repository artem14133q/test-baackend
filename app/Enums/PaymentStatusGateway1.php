<?php

namespace App\Enums;

use App\Enums\PaymentStatus as PaymentStatusEnum;

enum PaymentStatusGateway1: string
{
    case New = "new";
    case Pending = "pending";
    case Completed = "completed";
    case Expired = "expired";
    case Rejected = "rejected";

    public function preparedStatus(): PaymentStatus
    {
        return match ($this) {
            self::New => PaymentStatusEnum::Created,
            self::Pending => PaymentStatusEnum::InProgress,
            self::Completed => PaymentStatusEnum::Paid,
            self::Expired => PaymentStatusEnum::Expired,
            self::Rejected => PaymentStatusEnum::Rejected,
        };
    }
}
