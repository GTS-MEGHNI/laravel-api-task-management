<?php

declare(strict_types=1);

namespace App\Enums;

enum OtpContext: string
{
    case AccountActivation = 'account_activation';
}
