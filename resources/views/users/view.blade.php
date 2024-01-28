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
                        <h3 class="card-title">User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="holiday-details">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $user->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td>{{ $user->username ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Birth Date</th>
                                            <td>{{ $user->birth_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $user->birth_date)->format('d F, Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hire Date</th>
                                            <td>{{ $user->hire_date ? \Carbon\Carbon::createFromFormat('d/m/Y', $user->hire_date)->format('d F, Y') : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Role</th>
                                            <td>{{ $user->role ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>{{ $user->department->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td>{{ $user->designation->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>{{ $user->country->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $user->phone ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $user->status ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Blood Group</th>
                                            <td>{{ $user->blood_group ?? '' }}</td>
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
