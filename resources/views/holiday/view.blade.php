@extends('layouts.dashboard')

@section('style')
    <style>

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
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">Holiday</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="holiday-details">
                                    <table class="table">
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $holiday->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $holiday->start_date ? \Carbon\Carbon::parse($holiday->start_date)->format('d F, Y') : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>End Date</th>
                                            <td>{{ $holiday->end_date ? \Carbon\Carbon::parse($holiday->end_date)->format('d F, Y') : '' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge @if($holiday->status === \App\Constants\Status::PUBLISHED) badge-success @else badge-warning @endif p-2">
                                                            {{ $holiday->status ?? '' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $holiday->description ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <img class="rounded img-fluid image-preview" src="{{ asset($holiday->image_url) }}" width="80%" alt="image">
                                        </div>
                                    </div>
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
