<?php

namespace App\Services;

use App\Models\Holiday;
use Carbon\Carbon;

class HoliDayService
{
    public function storeHoliday(array $data, $image = null)
    {
        // Parse dates as Carbon instances
        $startDate = Carbon::parse($data['start_date'])->format('Y-m-d');
        $endDate = Carbon::parse($data['end_date'])->format('Y-m-d');

        $data = array_merge($data, [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $holiday = Holiday::create($data);

        if ($image) {
            $holiday->addMedia($image)
                ->toMediaCollection();
        }

        return $holiday;
    }

    public function updateHoliday(array $data, Holiday $holiday, $image = null)
    {
        $startDate = Carbon::parse($data['start_date'])->format('Y-m-d');
        $endDate = Carbon::parse($data['end_date'])->format('Y-m-d');

        $data = array_merge($data, [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

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
