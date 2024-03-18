<div class="row justify-content-center my-4">
    <div class="col-md-6">
        @if(!empty($chartData['data']) && array_sum($chartData['data']) > 0)
            <div class="attendance_chart">
                <canvas id="doughnutChart"></canvas>
            </div>
        @else
            <h2 class="text-center">No Attendance Found</h2>
        @endif
    </div>
    <div class="col-md-6 justify-content-center m-auto">
        <div class="check_in_out_main d-flex justify-content-center align-items-center">
            <div>
                <div class="status_button d-flex justify-content-around">
                    <button class="btn btn-success btn-sm ">On Time ( {{ $on_time }} )</button>
                    <button class="btn btn-danger btn-sm mx-2">Absent ( {{ $absent }} )</button>
                    <button class="btn btn-warning btn-sm ">Late ( {{ $late }} )</button>
                </div>
                <div class="check_in_out_time_date">
                    <h5 class="check_in_out_date">{{ \Carbon\Carbon::now()->format('Y F d D') }}</h5>
                    <h3 id="current_time"></h3>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @php
                        $ip_address = \App\Models\Settings::get('ip_address');
                        $current_ip = $_SERVER['REMOTE_ADDR'];
                    @endphp

                    @if ($ip_address)
                        @if (in_array($current_ip, unserialize($ip_address)))
                            <form action="{{ route('check-in-attendance') }}" method="post">
                                @csrf
                                <p class="mb-1 not_check_in_out text-center">{{ isset($today_attendance->check_in) ? date('h:i A', strtotime($today_attendance->check_in)) : 'Not Checked' }}</p>
                                <button
                                    {{ isset($today_attendance) && $today_attendance ? 'disabled' : '' }}  type="submit"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Are you sure to check in?')">Check In
                                </button>
                            </form>

                            <form action="{{ route('check-out-attendance') }}" method="post">
                                @csrf
                                <p class="mb-1 not_check_in_out text-center">{{ isset($today_attendance->check_out) ? date('h:i A', strtotime($today_attendance->check_out)) : 'Not Checked Out' }}</p>
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to check out?')"
                                    {{ isset($today_attendance->check_in) && !$today_attendance->check_out && $today_attendance->status === \App\Constants\AttendanceStatus::PRESENT ? '' : 'disabled' }}
                                >
                                    Check Out
                                </button>
                            </form>
                        @else
                            <strong>IP Address does not match our records</strong>
                        @endif
                    @else
                        <strong>IP Address Not Match</strong>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
