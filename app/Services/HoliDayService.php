<?php

namespace App\Services;

use App\Models\Holiday;

class HoliDayService
{
    public function storeHoliday(array $data, $image = null)
    {
        $holiday = Holiday::create($data);

        if ($image) {
            $holiday->addMedia($image)
                ->toMediaCollection();
        }

        return $holiday;
    }

    public function updateHoliday(array $data, Holiday $holiday, $image = null)
    {
        $holiday = tap($holiday)->update($data);

        if ($image) {
            $holiday->clearMediaCollection();
            $holiday->addMedia($image)
                ->toMediaCollection();
        }

        return $holiday;
    }

    public function destroyHoliday(Holiday $holiday)
    {
        $holiday->delete();
    }
}
