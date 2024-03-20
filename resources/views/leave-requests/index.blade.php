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
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">Leave Request List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('leave-request.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Add Leave Request</a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($leaveRequest->count() <= 0)
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
                                        <table class="table table-bordered table-striped" id="datatables">
                                            <thead>
                                            <tr>
                                                @foreach(['ID','Employee Name','Leave Type','Start Date','End Date','Day','Reference By','Status','Leave Reason','Comment By Authority','Action'] as $label)
                                                <th>{{ $label }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leaveRequest as $leave_request)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $leave_request->user->name ?? '' }}</td>
                                                    <td>{{ $leave_request->leavePolicy->title ?? '' }}</td>
                                                    <td>{{ $leave_request->start_date ? getDateFormat($leave_request->start_date) : '' }}</td>
                                                    <td>{{ $leave_request->end_date ? getDateFormat($leave_request->end_date) : '' }}</td>
                                                    <td>{{ $leave_request->days ?? '' }}</td>
                                                    <td>{{ $leave_request->referredBy->name ?? '' }}</td>
                                                    <td>
                                                        <span class="badge @if($leave_request->status === \App\Constants\LeaveStatus::APPROVED)  badge-success @elseif($leave_request->status === \App\Constants\LeaveStatus::REJECTED)  badge-warning @else badge-danger  @endif p-2">
                                                            {{ $leave_request->status ?? '' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($leave_request->leave_reason,20) ?? '' }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($leave_request->comment,20) ?? '' }}</td>
                                                    <td>
                                                        @if(auth()->user()->role === \App\Constants\Role::ADMIN || (auth()->user()->role === \App\Constants\Role::USER && ($leave_request->status !== \App\Constants\LeaveStatus::APPROVED && $leave_request->status !== \App\Constants\LeaveStatus::REJECTED)))
                                                            <a href="{{ route('leave-request.edit', $leave_request->id) }}" class="btn btn-info btn-sm mb-2 mb-sm-0"><i class="fas fa-edit"></i></a>
                                                        @else
                                                            <button disabled class="btn btn-info btn-sm mb-2 mb-sm-0"><i class="fas fa-edit"></i></button>
                                                        @endif

                                                        <a href="{{ route('leave-request.show',$leave_request->id) }}" class="btn btn-primary btn-sm mb-2 mb-sm-0"><i class="fas fa-eye"></i></a>

                                                        @if(auth()->user()->isAdmin())
                                                        <button data-delete-route="{{ route('leave-request.destroy', $leave_request->id) }}" class="btn btn-danger btn-sm delete-item-btn mb-2 mb-sm-0"><i class="fas fa-trash"></i></button>
                                                        @endif
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
