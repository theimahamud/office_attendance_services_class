<?php

namespace App\Http\Controllers;


use App\Constants\AttendanceStatus;
use App\Constants\Role;
use App\Models\Attendance;
use App\Models\Settings;
use App\Models\User;
use App\Services\AttendanceReport;
use App\Services\OfficeReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function officeReport(OfficeReportService $officeReportService)
    {
        $reportData = $officeReportService->generateReportData();

        return view('reports.office-report', $reportData);
    }

    public function attendanceReport()
    {
        if(auth()->user()->role === Role::ADMIN){
            $users = User::all();
        }else{
            $users = auth()->user();
        }

        $years = Attendance::selectRaw('YEAR(check_in_out_date) as year')
            ->distinct()
            ->pluck('year');

        return view('reports.attendance-report',compact('users','years'));
    }


    public function reportGenerate(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $user = User::find($request->user_id);
        $company_name = Settings::get('title') ?? 'Uibarn Ltd';
        $attendance_report = AttendanceReport::generateAttendance($request);

        // Pass the calculated values to the view
        return view('reports.generate-report', compact(
            'attendance_report',
            'user',
            'month',
            'year',
            'company_name'
        ));
    }



    public function downloadAttendanceReport(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $user = User::where('id',$request->user_id)->first();
        $company_name = Settings::get('company_name') ?? 'Uibarn Ltd';
        $attendance_report = AttendanceReport::generateAttendance($request);

        // Generate the PDF content
        $pdfContent = view('reports.download-report', compact('attendance_report', 'user', 'month', 'year', 'company_name'))->render();

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfContent);

        // (Optional) Adjust the PDF settings
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF content
        $dompdf->render();

        // Generate the file name
        $fileName = 'attendance_report.pdf';

        // Download the PDF file
        return $dompdf->stream($fileName);
    }

}
