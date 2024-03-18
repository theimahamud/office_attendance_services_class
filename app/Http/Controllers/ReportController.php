<?php

namespace App\Http\Controllers;

use App\Constants\Gender;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use App\Services\OfficeReportService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function officeReport(OfficeReportService $officeReportService)
    {
        $reportData = $officeReportService->generateReportData();

        return view('reports.office-report', $reportData);
    }

    public function attendanceReport()
    {
        $users = User::all();
        $years = Attendance::selectRaw('YEAR(check_in_out_date) as year')
            ->distinct()
            ->pluck('year');
        return view('reports.attendance-report',compact('users','years'));
    }

}
