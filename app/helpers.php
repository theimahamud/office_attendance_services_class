<?php

use Carbon\Carbon;

if (! function_exists('getDateFormat')) {
    function getDateFormat(string $date): string
    {
        return Carbon::parse($date)->format('d F, Y');
    }
}
