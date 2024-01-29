@extends('layouts.dashboard')

@section('style')

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
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/admin/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ ucfirst($user->name) }}</h3>

                                <p class="text-muted text-center">{{ ucfirst($user->designation->title) }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Department</b> <a class="float-right">{{ isset($user->department->title) ? ucfirst($user->department->title) : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Role</b> <a class="float-right">{{ isset($user->role) ? ucfirst($user->role) : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ isset($user->email) ? $user->email : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Username</b> <a class="float-right">{{ isset($user->username) ? $user->username : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Birth Date</b> <a class="float-right">{{ isset($user->birth_date) ? \Carbon\Carbon::parse($user->birth_date)->format('d F, Y') : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Hire Date</b> <a class="float-right">{{ isset($user->hire_date) ? \Carbon\Carbon::parse($user->hire_date)->format('d F, Y') : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone</b> <a class="float-right">{{ isset($user->phone) ? $user->phone : '' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Country</b> <a class="float-right">{{ isset($user->country->name) ? ucfirst($user->country->name) : '' }}</a>
                                    </li>
                                </ul>

                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-block"><b> <i class="fas fa-edit"></i> Edit</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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
