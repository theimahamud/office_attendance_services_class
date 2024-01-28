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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
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
                                    <div class="col-sm-12">
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
                                                    <td>{{ $user->status ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                        <button data-delete-route="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm delete-item-btn">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        {{ $users->links() }}
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
