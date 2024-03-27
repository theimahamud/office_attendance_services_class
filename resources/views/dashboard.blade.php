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
                @include('common.dashboard.today-attendance')
                @include('common.dashboard.announcement')
                @include('common.dashboard.calendar')

            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>

        function updateTime() {
            var date = new Date();
            var formattedTime = date.toLocaleTimeString('en-US', { hour12: true });
            $('#current_time').text(formattedTime);
        }
        setInterval(updateTime, 1000);

        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    data: @json($chartData['data']),
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.7)',   // On Time (Success)
                        'rgba(220, 53, 69, 0.7)',   // Absent (Danger)
                        'rgba(255, 193, 7, 0.7)',   // Late (Warning)
                        'rgba(23, 162, 184, 0.7)', // Holiday (Info)
                        'rgba(0, 123, 255, 0.7)',  // Leave (Primary)
                        'rgba(108, 117, 125, 0.7)',// Weekend (Secondary)
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',    // On Time (Success)
                        'rgba(220, 53, 69, 1)',    // Absent (Danger)
                        'rgba(255, 193, 7, 1)',    // Late (Warning)
                        'rgba(23, 162, 184, 1)',   // Holiday (Info)
                        'rgba(0, 123, 255, 1)',    // Leave (Primary)
                        'rgba(108, 117, 125, 1)',  // Weekend (Secondary)
                    ],
                    borderWidth: 1
                }]
            },
        });
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
                height: 600,
                aspectRatio: 1.5
            });
        });
    </script>


@endsection
