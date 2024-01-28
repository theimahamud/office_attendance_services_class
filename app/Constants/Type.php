<?php

namespace App\Constants;

class Type
{
    public const FULL_TIME = 'Full Time';

    public const PART_TIME = 'Part Time';

    public const CONTACT = 'Contact';

    public const TEMPORARY = 'Temporary';

    public const types = [
        self::FULL_TIME,
        self::PART_TIME,
        self::CONTACT,
        self::TEMPORARY,
    ];
}
