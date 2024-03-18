<div class="row justify-content-center my-4">
    <div class="col-md-12">
        <div class="today_attendance table-responsive">
            <div class="card">
                <h3 class="card-header"><i class="fas fa-calendar-check"></i> Today Attendance</h3>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Work Hour</th>
                        </tr>
                        <tbody>
                        <tr>
                            <td>{{ isset($today_attendance->check_in_out_date) ? $today_attendance->check_in_out_date : '' }}</td>
                            <td>{{ isset($today_attendance->check_in) ? date('h:i A', strtotime($today_attendance->check_in)) : '' }}</td>
                            <td>{{ isset($today_attendance->check_out) ? date('h:i A', strtotime($today_attendance->check_out)) : '' }}</td>
                            <td>{{ isset($today_attendance->check_in) && isset($today_attendance->check_out) ? workHour($today_attendance->check_in, $today_attendance->check_out) : '' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
