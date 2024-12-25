<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Created = 1;
    case InProgress = 2;
    case Paid = 3;
    case Expired = 4;
    case Rejected = 5;
}
