<?php

namespace App\Services;

use App\Models\Holiday;

class HoliDayService
{
    public function storeHoliday(array $data)
    {
        $holiday = Holiday::create($data);

        return $holiday;
    }

    public function updateHoliday(array $data, Holiday $holiday)
    {
        $holiday = $holiday->update($data);

        return $holiday;
    }

    public function destroyHoliday(Holiday $holiday)
    {
        $holiday->delete();
    }
}
