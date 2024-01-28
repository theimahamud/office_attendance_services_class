@extends('layouts.dashboard')

@section('style')
    <style>
        .holiday-details table {
            width: 100%;
        }

        .holiday-details th, .holiday-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .holiday-details th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .holiday-details td {
            background-color: #fff;
        }

        .holiday-details tr:hover {
            background-color: #f5f5f5;
        }

    </style>
@endsection

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
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Holiday</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="holiday-details">
                                    <table class="table">
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $holiday->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $holiday->start_date ? \Carbon\Carbon::parse($holiday->start_date)->format('d F, Y') : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $holiday->end_date ? \Carbon\Carbon::parse($holiday->end_date)->format('d F, Y') : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $holiday->status ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $holiday->description ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

    @include('layouts.assets.delete-script')

@endsection
