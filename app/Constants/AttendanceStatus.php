<?php

namespace App\Constants;

class AttendanceStatus
{
    public const PRESENT = 'Present';

    public const ABSENT = 'Absent';

    public const HOLIDAY = 'Holiday';

    public const LEAVE = 'Leave';

    public const ATTENDANCE_STATUS = [
        self::PRESENT,
        self::ABSENT,
        self::HOLIDAY,
        self::LEAVE,
    ];
}
