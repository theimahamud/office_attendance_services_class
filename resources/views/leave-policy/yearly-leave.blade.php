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
                                <h3 class="card-title">Yearly Leave List</h3>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($yearlyLeave->count() <= 0)
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/dist/img/no-result.png') }}" alt="No result">
                                <h3 class="p-6 text-center">
                                    No data found
                                </h3>
                            </div>
                        @else
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                                                <th>Status</th>
                                                <th>In Days</th>
                                                <th>Availability</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($yearlyLeave as $leavePolicy)
                                                <tr>
                                                    @php
                                                        $leave_spent = \App\Helper\Helper::leaveSpent($leavePolicy->id, $leavePolicy->start_date, $leavePolicy->end_date);
                                                        $available_days = \App\Helper\Helper::availableDays($leavePolicy->maximum_in_year, $leave_spent);
                                                        $total_days = \Carbon\Carbon::parse($leavePolicy->start_date)->diffInDays($leavePolicy->end_date);
                                                    @endphp

                                                    <td>{{ ucfirst($leavePolicy->title) ?? '' }}</td>
                                                    <td class="text-center">
                                                        <h5><span class="badge badge-primary">{{ $leavePolicy->maximum_in_year ?? '' }}</span></h5>
                                                    </td>
                                                    <td class="text-center">
                                                        <h5><span class="badge badge-danger">{{ $leave_spent }}</span></h5>
                                                    </td>
                                                    <td class="text-center">
                                                        <h5><span class="badge badge-warning">{{ $available_days }}</span></h5>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($leavePolicy->start_date)->format('d-m-Y') .' - '.\Carbon\Carbon::parse($leavePolicy->end_date)->format('d-m-Y') ?? '' }}</td>
                                                    <td>
                                                        <span class="badge @if($leavePolicy->status === \App\Constants\Status::ACTIVE) badge-success @else badge-warning @endif p-2">
                                                             {{ $leavePolicy->status ?? '' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $total_days }}</td>
                                                    <td>
                                                        <div>
                                                            @if($current_date >= $leavePolicy->start_date && $current_date <= $leavePolicy->end_date && $leavePolicy->status === \App\Constants\Status::ACTIVE)
                                                                <h5><span class="badge badge-success p-2">Available</span></h5>
                                                            @elseif($current_date >= $leavePolicy->start_date && $current_date <= $leavePolicy->end_date && $leavePolicy->status === \App\Constants\Status::INACTIVE)
                                                                <h5><span class="badge badge-warning p-2">Inactive</span></h5>
                                                            @else
                                                                <h5><span class="badge badge-danger p-2">Expired</span></h5>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        @endif
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
