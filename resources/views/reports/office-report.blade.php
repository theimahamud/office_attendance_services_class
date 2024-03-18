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
                            <li class="breadcrumb-item active">Office Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h3 class="card-title">Gender Radio</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <div style="width: 80%; margin: auto;">
                                                <canvas id="genderBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h3 class="card-title">Department Radio</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <div style="width: 80%; margin: auto;">
                                                <canvas id="departmentBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h3 class="card-title">Designation Radio</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <div style="width: 80%; margin: auto;">
                                                <canvas id="designationBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h3 class="card-title">Age Radio</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <div style="width: 80%; margin: auto;">
                                                <canvas id="ageBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
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
        var ctx = document.getElementById('genderBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($gender_data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($gender_data['data']),
                    backgroundColor: @json($gender_data['colors']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        precision: 0
                    },
                }
            }
        });


        var ctx = document.getElementById('departmentBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($department_data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($department_data['data']),
                    backgroundColor: @json($department_data['colors']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        precision: 0
                    },
                }
            }
        });

        var ctx = document.getElementById('designationBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($designation_data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($designation_data['data']),
                    backgroundColor: @json($designation_data['colors']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        precision: 0
                    },
                }
            }
        });
        var ctx = document.getElementById('ageBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($age_data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($age_data['data']),
                    backgroundColor: @json($age_data['colors']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        precision: 0
                    },
                }
            }
        });
    </script>
@endsection
