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
                                <h3 class="card-title">Leave Request</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="holiday-details table-responsive">
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
                                            <td> <h5><span class="badge badge-info px-2"> {{ $leaveRequest->days ?? '' }}</span></h5></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge @if($leaveRequest->status === \App\Constants\LeaveStatus::APPROVED)  badge-success @elseif($leaveRequest->status === \App\Constants\LeaveStatus::REJECTED)  badge-warning @else badge-danger  @endif p-2">
                                                    {{ $leaveRequest->status ?? '' }}
                                                </span>
                                            </td>
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
                                @if(auth()->user()->isAdmin())
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 mt-4">
                                    <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Leave Type</th>
                                                    <th>Total Days</th>
                                                    <th>Leave Spent</th>
                                                    <th>Available Days</th>
                                                    <th>Leave Period (From-To)</th>
                                                    <th>In Days</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                @if(filled($yearlyLeave))
                                                    <tbody>
                                                    @foreach($yearlyLeave as $leavePolicy)
                                                        <tr>
                                                            @php
                                                                $leave_spent = \App\Helper\Helper::leaveSpent($leavePolicy->id, $leavePolicy->start_date, $leavePolicy->end_date,$leaveRequest->user_id);
                                                                $available_days = \App\Helper\Helper::availableDays($leavePolicy->maximum_in_year, $leave_spent);
                                                                $total_days = \Carbon\Carbon::parse($leavePolicy->start_date)->diffInDays($leavePolicy->end_date);
                                                            @endphp

                                                            <td>{{ ucfirst($leavePolicy->title) ?? '' }}</td>
                                                            <td class="text-center">
                                                                <h5><span
                                                                        class="badge badge-primary px-2">{{ $leavePolicy->maximum_in_year ?? '' }}</span>
                                                                </h5>
                                                            </td>
                                                            <td class="text-center">
                                                                <h5><span
                                                                        class="badge badge-danger px-2">{{ $leave_spent }}</span>
                                                                </h5>
                                                            </td>
                                                            <td class="text-center">
                                                                <h5><span
                                                                        class="badge badge-warning px-2">{{ $available_days }}</span>
                                                                </h5>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($leavePolicy->start_date)->format('d-m-Y') .' - '.\Carbon\Carbon::parse($leavePolicy->end_date)->format('d-m-Y') ?? '' }}</td>
                                                            <td>{{ $total_days }}</td>
                                                            <td>
                                                                <div>
                                                                    @if($current_date >= $leavePolicy->start_date && $current_date <= $leavePolicy->end_date)
                                                                        <h5><span
                                                                                class="badge badge-success p-2">Active</span>
                                                                        </h5>
                                                                    @else
                                                                        <h5><span
                                                                                class="badge badge-danger p-2">Expired</span>
                                                                        </h5>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
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
