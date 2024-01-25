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
                                                        <a href="{{ route('users.edit',$user->uuid) }}" class="btn btn-info btn-sm">Edit</a>
                                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="example1_previous"><a href="#" aria-controls="example1"
                                                                              data-dt-idx="0" tabindex="0"
                                                                              class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                                                                aria-controls="example1"
                                                                                                data-dt-idx="1" tabindex="0"
                                                                                                class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                          data-dt-idx="2" tabindex="0"
                                                                                          class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                          data-dt-idx="3" tabindex="0"
                                                                                          class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                          data-dt-idx="4" tabindex="0"
                                                                                          class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                          data-dt-idx="5" tabindex="0"
                                                                                          class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                                                                          data-dt-idx="6" tabindex="0"
                                                                                          class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                                                                                                 aria-controls="example1"
                                                                                                                 data-dt-idx="7"
                                                                                                                 tabindex="0"
                                                                                                                 class="page-link">Next</a>
                                                </li>
                                            </ul>
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
