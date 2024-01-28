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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($department) }}</h3>
                                <h4>Departments</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-briefcase"></i>
                            </div>
                            <a href="{{ route('departments.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($designation) }}</h3>
                                <h4>Designations</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            <a href="{{ route('designations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ count($user) }}</h3>
                                <h4>Users</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
                <!-- Main row -->
               <div class="row">
                   <div class="col-md-12">


                   </div>
               </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
