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
                                <h3 class="card-title">User List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('users.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Add User</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($users->count() <= 0)
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
                                    <div class="col-sm-12 table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name ?? '' }}</td>
                                                    <td>{{ $user->email ?? '' }}</td>
                                                    <td>{{ $user->username ?? '' }}</td>
                                                    <td>{{ $user->role ?? '' }}</td>
                                                    <td>{{ $user->department->title ?? '' }}</td>
                                                    <td>{{ $user->designation->title ?? '' }}</td>
                                                    <td>
                                                        <span class="badge @if($user->status === \App\Constants\Status::ACTIVE) badge-success @else badge-danger @endif p-2">
                                                            {{ $user->status ?? '' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('users.show',$user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                        <button data-delete-route="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm delete-item-btn"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="float-right">
                                            {{ $users->links() }}
                                        </div>
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
