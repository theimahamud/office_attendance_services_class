<div class="row align-items-center justify-content-center my-4">

    <div class="col-md-5 d-flex justify-content-center align-items-center">
        @if(!empty($chartData['data']) && array_sum($chartData['data']) > 0)
            <div class="attendance_chart">
                <canvas id="doughnutChart"></canvas>
            </div>
        @else
            <h2 class="text-center">No Attendance Found</h2>
        @endif
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="check-in-out-main text-center">
                        <div class="status-buttons d-flex justify-content-around flex-wrap">
                            <button class="btn btn-success btn-sm mr-2 mb-2 mb-md-0">On Time ({{ $on_time }})</button>
                            <button class="btn btn-danger btn-sm mr-2 mb-2 mb-md-0">Absent ({{ $absent }})</button>
                            <button class="btn btn-warning btn-sm mr-2 mb-2 mb-md-0">Late ({{ $late }})</button>
                            <button class="btn btn-info btn-sm mr-2 mb-2 mb-md-0">Holiday ({{ $holiday_percent }})</button>
                            <button class="btn btn-primary btn-sm mr-2 mb-2 mb-md-0">Leave ({{ $leave_percent }})</button>
                            <button class="btn btn-secondary btn-sm mr-2 mb-2 mb-md-0">Weekend ({{ $weekend_percent }})</button>
                        </div>
                        <div class="check-in-out-time-date mt-3">
                            <h5 class="check-in-out-date">{{ \Carbon\Carbon::now()->format('Y F d D') }}</h5>
                            <h3 id="current_time"></h3>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center flex-wrap"> <!-- Add flex-wrap class for form responsiveness -->
                        @php
                            $ip_address = \App\Models\Settings::get('ip_address');
                            $current_ip = $_SERVER['REMOTE_ADDR'];
                        @endphp

                        @if ($ip_address !== null)
                            @php
                                $unserialized_ip_address = unserialize($ip_address);
                            @endphp

                            @if (is_array($unserialized_ip_address) && in_array($current_ip, $unserialized_ip_address))

                                <div class="">
                                    <form action="{{ route('check-in-attendance') }}" method="post">
                                        @csrf
                                        <p class="mb-1 not-check-in-out text-center">{{ isset($today_attendance->check_in) ? date('h:i A', strtotime($today_attendance->check_in)) : 'Not Checked' }}</p>
                                        <button type="submit" class="btn btn-success px-4" {{ isset($today_attendance) && $today_attendance ? 'disabled' : '' }} onclick="return confirm('Are you sure to check in?')">Check In</button>
                                    </form>
                                </div>
                                <div class="">
                                    <form action="{{ route('check-out-attendance') }}" method="post">
                                        @csrf
                                        <p class="mb-1 not-check-in-out text-center">{{ isset($today_attendance->check_out) ? date('h:i A', strtotime($today_attendance->check_out)) : 'Not Checked Out' }}</p>
                                        <button type="submit" class="btn btn-danger px-4" onclick="return confirm('Are you sure you want to check out?')" {{ isset($today_attendance->check_in) && !$today_attendance->check_out && $today_attendance->status === \App\Constants\AttendanceStatus::PRESENT ? '' : 'disabled' }}>Check Out</button>
                                    </form>
                                </div>

                            @else
                                <strong>IP Address does not match our records</strong>
                            @endif
                        @else
                            <strong>IP Address Not Found</strong>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
