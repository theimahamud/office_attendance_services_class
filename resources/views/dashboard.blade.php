@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($department) }}</h3>
                                <h4>Departments</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-briefcase"></i>
                            </div>
                            <a href="{{ route('departments.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($designation) }}</h3>
                                <h4>Designations</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            <a href="{{ route('designations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ count($user) }}</h3>
                                <h4>Users</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
                <!-- Main row -->
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
                                   <button class="btn btn-success btn-sm">Check In</button>
                                   <button class="btn btn-danger btn-sm">Check Out</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                <div class="row justify-content-center my-4">
                    <div class="col-md-12">
                        <div class="calendar-main">
                            <div id="calendar_event"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center my-4">
                    <div class="col-md-12">
                        <div class="today_attendance table-responsive">
                           <div class="card">
                               <h3 class="card-header">Today Attendance</h3>
                               <div class="card-body">
                                   <table class="table table-bordered">
                                       <tr>
                                           <td>Date</td>
                                           <td>Check In</td>
                                           <td>Check Out</td>
                                           <td>Work Hour</td>
                                       </tr>
                                       <tbody>
                                           <tr>
                                               <td>{{ $today_attendance->check_in_out_date }}</td>
                                               <td>{{ date('h:i A', strtotime($today_attendance->check_in)) }}</td>
                                               <td>{{ date('h:i A', strtotime($today_attendance->check_out)) }}</td>
                                               <td>{{ workHour($today_attendance->check_in,$today_attendance->check_out) }}</td>
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
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
        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    data: @json($chartData['data']),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',  // On Time (Green)
                        'rgba(255, 99, 132, 0.7)',  // Absent (Red)
                        'rgba(255, 206, 86, 0.7)',  // Late (Yellow/Orange)
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        function updateTime() {
            var date = new Date();
            var formattedTime = date.toLocaleTimeString('en-US', { hour12: true });
            $('#current_time').text(formattedTime);
        }
        // Update the time every second (1000 milliseconds)
        setInterval(updateTime, 1000);
    </script>

    <script>
        $(document).ready(function () {
            var events = @json($events);

            $('#calendar_event').fullCalendar({
                // editable:true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: events,
                selectable: true,
                selectHelper: true,
                displayEventTime: false,
                height: 600, // Set the height as per your requirement
                aspectRatio: 1.5 // Set the aspect ratio to control the width (width = height * aspectRatio)
            });
        });
    </script>


@endsection
