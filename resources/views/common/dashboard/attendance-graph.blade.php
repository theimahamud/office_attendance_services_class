<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <div class="attendance_chart">
            <canvas id="doughnutChart"></canvas>
        </div>
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

                <div class="d-flex justify-content-around">
                    @php
                        $ip_address = \App\Models\Settings::get('ip_address');
                        $current_ip = $_SERVER['REMOTE_ADDR'];
                    @endphp

                    @if ($ip_address)
                        @if (in_array($current_ip, unserialize($ip_address)))
                            <button type="submit" class="btn btn-success btn-sm">Check In</button>
                            <button type="submit" class="btn btn-danger btn-sm">Check Out</button>
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
