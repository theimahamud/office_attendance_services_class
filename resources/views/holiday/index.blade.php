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
                <div class="row">
                    <div class="col-sm-12">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {!! session('error') !!}
                            </div>
                        @endif
                    </div>
                </div>
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
                               <h3 class="card-title">Holiday List</h3>
                           </div>
                           <div class="col-md-6 text-right">
                               <a href="{{ route('holiday.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Add Holiday</a>
                           </div>
                       </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($holidays->count() <= 0)
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/dist/img/no-result.png') }}" alt="No result">
                                <h3 class="p-6 text-center">
                                    No data found
                                </h3>
                            </div>
                        @else
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div  class="dataTables_filter "><label>Search:<input
                                                    type="search" class="form-control form-control-sm"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($holidays as $holiday)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $holiday->title ?? '' }}</td>
                                                    <td>{{ $holiday->start_date ? \Carbon\Carbon::parse($holiday->start_date)->format('d F, Y') : '' }}</td>
                                                    <td>{{ $holiday->end_date ? \Carbon\Carbon::parse($holiday->end_date)->format('d F, Y') : '' }}</td>
                                                    <td>{{ $holiday->status ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('holiday.edit',$holiday->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('holiday.show',$holiday->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                        <button data-delete-route="{{ route('holiday.destroy', $holiday->id) }}" class="btn btn-danger btn-sm delete-item-btn"><i class="fas fa-trash"></i></button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        {{ $holidays->links() }}
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
