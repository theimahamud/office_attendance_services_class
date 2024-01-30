@extends('layouts.dashboard')

@section('style')
    <style>

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
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">Leave Policy</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="holiday-details">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $leaveRequest->user->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $leaveRequest->start_date ? getDateFormat($leaveRequest->start_date) : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $leaveRequest->start_date ? getDateFormat($leaveRequest->start_date) : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Days</th>
                                            <td>{{ $leaveRequest->days ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $leaveRequest->status ?? '' }}</td>
                                        </tr>
                                        @if($leaveRequest->referred_by)
                                        <tr>
                                            <th>Reference By</th>
                                            <td>{{ $leaveRequest->referredBy->name ?? '' }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Leave Reason</th>
                                            <td>{{ $leaveRequest->leave_reason ?? '' }}</td>
                                        </tr>
                                        @if($leaveRequest->comment)
                                        <tr>
                                            <th>Comment By Authority</th>
                                            <td>{{ $leaveRequest->comment ?? '' }}</td>
                                        </tr>
                                        @endif
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
