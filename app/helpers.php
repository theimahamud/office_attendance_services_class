<?php

use Carbon\Carbon;

if (! function_exists('getDateFormat')) {
    function getDateFormat(string $date): string
    {
        return Carbon::parse($date)->format('d F, Y');
    }
}


if (! function_exists('workHour')) {
    function workHour(string $check_in,$check_out): string
    {
        $checkIn = strtotime($check_in);
        $checkOut = strtotime($check_out);
        $workHour = ($checkOut - $checkIn) / 3600;
        return number_format($workHour, 2).' h';
    }
}
