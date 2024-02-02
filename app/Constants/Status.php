<?php

namespace App\Constants;

class Status
{
    public const ACTIVE = 'Active';

    public const INACTIVE = 'Inactive';

    public const PUBLISHED = 'Published';

    public const DRAFT = 'Draft';

    public const status = [
        self::ACTIVE,
        self::INACTIVE,
    ];

    public const published_draft_status = [
        self::PUBLISHED,
        self::DRAFT,
    ];
}
