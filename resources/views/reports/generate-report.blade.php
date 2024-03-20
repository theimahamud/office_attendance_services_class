@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <!-- Main content -->
        <section class="content mt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <div class="card-title">
                                    <form action="{{ route('download-attendance-report') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="month" value="{{ $month }}">
                                        <input type="hidden" name="year" value="{{ $year }}">
                                        <button type="submit" class="btn btn-warning">Download Report</button>
                                    </form>
                                </div>
                                <div><a class="btn btn-dark px-3 float-right" href="{{ url()->previous() }}">Back</a></div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-3">
                                        <table class="table user_info_attendance_report">
                                            <tr>
                                                <td><strong>Name:</strong></td>
                                                <td>:</td>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Month:</strong></td>
                                                <td>:</td>
                                                <td>{{  date("F", mktime(0, 0, 0, $month, 1)) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Year:</strong></td>
                                                <td>:</td>
                                                <td>{{ $year }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Company:</strong></td>
                                                <td>:</td>
                                                <td>{{ $company_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date</strong></td>
                                                <td>:</td>
                                                <td><span id="currentDate"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Check-in Time</th>
                                            <th>Check-out Time</th>
                                            <th>Status</th>
                                            <th>Work Hour</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($attendance_report as $key => $attendance)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $attendance->check_in_out_date }}</td>
                                                <td>{{ isset($attendance->check_in) ? date('h:i A', strtotime($attendance->check_in)) : 'Null' }}</td>
                                                <td>{{ isset($attendance->check_out) ? date('h:i A', strtotime($attendance->check_out)) : 'Null' }}</td>
                                                <td style="color:
                                                @switch($attendance->status)
                                                @case('Absent')
                                                    red
                                                @break
                                                @case('Present')
                                                    green
                                                @break
                                                @case('Weekend')
                                                    blue
                                                @break
                                                @case('Holiday')
                                                    orange
                                                @break
                                                @case('Leave')
                                                    purple
                                                @break
                                                @default
                                                    black
                                                @endswitch
                                                    ">{{ $attendance->status }}</td>
                                                <td>
                                                    @if(isset($attendance->check_in) && isset($attendance->check_out))
                                                        {{ \Carbon\Carbon::parse($attendance->check_in)->diff(\Carbon\Carbon::parse($attendance->check_out))->format('%Hh %Im') }}
                                                    @else
                                                        Null
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center"><strong>Attendance Summery {{ date("F", mktime(0, 0, 0, $month, 1)) }} {{ $year }}</strong></h3>
                            </div>
                            <div class="card-body">
                                <table class="table user_info_attendance_report">
                                    <tr>
                                        <td><strong>Total Working Days</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalWorkingDays }}</td>
                                        <td><strong>Total Work Time</strong></td>
                                        <td>:</td>
                                        <td>{{ floor($totalWorkTime / 3600) }} h {{ floor(($totalWorkTime % 3600) / 60) }} m</td>
                                    </tr>

{{--                                    <tr>--}}
{{--                                        <td><strong>Average Check In Time</strong></td>--}}
{{--                                        <td>:</td>--}}
{{--                                        <td>{{ $averageCheckInHours }}h {{ $averageCheckInMinutes }}m</td>--}}
{{--                                        <td><strong>Average Check Out Time</strong></td>--}}
{{--                                        <td>:</td>--}}
{{--                                        <td>{{ $averageCheckOutHours }}h {{ $averageCheckOutMinutes }}m</td>--}}
{{--                                    </tr>--}}
                                    <tr>
                                        <td><strong>Total Present</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalPresent }}</td>
                                        <td><strong>Total Absent</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalAbsent }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Holiday</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalHoliday }}</td>
                                        <td><strong>Total Weekend</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalWeekend }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Leave</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalLeave }}</td>
                                        <td><strong>Total Early Left</strong></td>
                                        <td>:</td>
{{--                                        <td>{{ $totalEarlyLeft }}</td>--}}
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td><strong>Total In Time</strong></td>--}}
{{--                                        <td>:</td>--}}
{{--                                        <td>{{ $totalInTime }}</td>--}}
{{--                                        <td><strong>Total Late</strong></td>--}}
{{--                                        <td>:</td>--}}
{{--                                        <td>{{ $totalLate }}</td>--}}
{{--                                    </tr>--}}
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        // JavaScript to get and display the current date in "Y-m-d" format
        const currentDateElement = document.getElementById('currentDate');
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDate = `${day}-${month}-${year}`;
        currentDateElement.textContent = formattedDate;
    </script>
@endsection
