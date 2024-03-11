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
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

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
               <div class="row justify-content-center">
                   <div class="col-md-6">
                       <div class="">
                           <div style="width: 60%;  margin: auto;">
                               <canvas id="doughnutChart"></canvas>
                           </div>
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
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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


@endsection
