<?php

namespace App\Constants;

class LeaveStatus
{
    public const PENDING = 'Pending';

    public const REJECTED = 'Rejected';

    public const APPROVED = 'Approved';

    public const status = [
        self::PENDING,
        self::REJECTED,
        self::APPROVED,
    ];
}
