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

                @if($currentUser->isAdmin())
                @include('common.dashboard.statistics')
                @endif

                @include('common.dashboard.attendance-graph')
                @include('common.dashboard.calendar')
                @include('common.dashboard.today-attendance')
                @include('common.dashboard.announcement')

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
