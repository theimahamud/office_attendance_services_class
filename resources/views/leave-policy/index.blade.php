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
                                <h3 class="card-title">Leave Policy List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('leave-policy.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Add Leave Policy</a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($leavePolicies->count() <= 0)
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
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Maximum In Year</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leavePolicies as $leavePolicy)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $leavePolicy->title ?? '' }}</td>
                                                    <td>{{ $leavePolicy->start_date ? getDateFormat($leavePolicy->start_date) : '' }}</td>
                                                    <td>{{ $leavePolicy->end_date ? getDateFormat($leavePolicy->end_date) : '' }}</td>
                                                    <td>{{ $leavePolicy->maximum_in_year ?? '' }}</td>
                                                    <td>
                                                        <span class="badge @if($leavePolicy->status === \App\Constants\Status::ACTIVE) badge-success @else badge-warning @endif p-2">
                                                             {{ $leavePolicy->status ?? '' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('leave-policy.edit',$leavePolicy->id) }}" class="btn btn-info btn-sm mb-2 mb-sm-0"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('leave-policy.show',$leavePolicy->id) }}" class="btn btn-primary btn-sm mb-2 mb-sm-0"><i class="fas fa-eye"></i></a>
                                                        <button data-delete-route="{{ route('leave-policy.destroy', $leavePolicy->id) }}" class="btn btn-danger btn-sm delete-item-btn mb-2 mb-sm-0"><i class="fas fa-trash"></i></button>
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
