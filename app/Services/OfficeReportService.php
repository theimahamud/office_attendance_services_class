<?php


namespace App\Services;


use App\Constants\Gender;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OfficeReportService
{
    public function generateReportData()
    {
        $male = User::where('gender', Gender::MALE)->count();
        $female = User::where('gender', Gender::FEMALE)->count();
        $other = User::where('gender', Gender::OTHER)->count();

        $departmentCounts = $this->getDepartmentCounts();
        $designationCounts = $this->getDesignationCounts();
        $ageCounts = $this->getAgeCounts();

        $departmentColors = $this->generateRandomColors(count($departmentCounts));
        $designationColors = $this->generateRandomColors(count($designationCounts));

        return [
            'gender_data' => [
                'labels' => Gender::gender,
                'data' => [$male, $female, $other],
                'colors' => ['#3366cc', '#ff9900', '#109618'],
            ],
            'department_data' => [
                'labels' => array_keys($departmentCounts),
                'data' => array_values($departmentCounts),
                'colors' => $departmentColors,
            ],
            'designation_data' => [
                'labels' => array_keys($designationCounts),
                'data' => array_values($designationCounts),
                'colors' => $designationColors,
            ],
            'age_data' => [
                'labels' => array_keys($ageCounts),
                'data' => array_values($ageCounts),
                'colors' => ['#3366cc', '#ff9900', '#109618', '#9900ff', '#ffcc00', '#cc0099', '#66ccff'],
            ],
        ];
    }

    private function getDepartmentCounts()
    {
        $departmentCounts = DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->select('departments.title', DB::raw('count(*) as count'))
            ->groupBy('departments.title')
            ->pluck('count', 'title')
            ->toArray();

        $departments = Department::pluck('title')->toArray();
        foreach ($departments as $department) {
            if (!isset($departmentCounts[$department])) {
                $departmentCounts[$department] = 0;
            }
        }

        return $departmentCounts;
    }

    private function getDesignationCounts()
    {
        $designationCounts = DB::table('users')
            ->join('designations', 'users.designation_id', '=', 'designations.id')
            ->select('designations.title', DB::raw('count(*) as count'))
            ->groupBy('designations.title')
            ->pluck('count', 'title')
            ->toArray();

        $designations = Designation::pluck('title')->toArray();
        foreach ($designations as $designation) {
            if (!isset($designationCounts[$designation])) {
                $designationCounts[$designation] = 0;
            }
        }

        return $designationCounts;
    }

    private function getAgeCounts()
    {
        $ageRanges = [
            'Under 18' => [0, 17],
            '18 - 25' => [18, 25],
            '26 - 35' => [26, 35],
            '36 - 45' => [36, 45],
            '46 - 55' => [46, 55],
            '56 - 65' => [56, 65],
            '65+' => [66, null],
        ];

        $ageCounts = array_fill_keys(array_keys($ageRanges), 0);
        $users = User::all();

        foreach ($users as $user) {
            $age = Carbon::parse($user->birth_date)->age;
            foreach ($ageRanges as $range => $limits) {
                if (($limits[1] === null && $age >= $limits[0]) || ($age >= $limits[0] && $age <= $limits[1])) {
                    $ageCounts[$range]++;
                    break;
                }
            }
        }

        return $ageCounts;
    }

    private function generateRandomColors($count)
    {
        $colors = [];

        for ($i = 0; $i < $count; $i++) {
            $color = $this->random_color();
            $colors[] = $color;
        }

        return $colors;
    }

    private function random_color()
    {
        $red = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $blue = mt_rand(0, 255);
        return sprintf("#%02x%02x%02x", $red, $green, $blue);
    }

}
