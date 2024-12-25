<?php

namespace App\Enums;

use App\Enums\PaymentStatus as PaymentStatusEnum;

enum PaymentStatusGateway2: string
{
    case Created = "created";
    case InProgress = "inprogress";
    case Paid = "paid";
    case Completed = "completed";
    case Expired = "expired";
    case Rejected = "rejected";

    public function preparedStatus(): PaymentStatus
    {
        return match ($this) {
            self::Created => PaymentStatusEnum::Created,
            self::InProgress => PaymentStatusEnum::InProgress,
            self::Paid, self::Completed => PaymentStatusEnum::Paid,
            self::Expired => PaymentStatusEnum::Expired,
            self::Rejected => PaymentStatusEnum::Rejected,
        };
    }
}
