@extends('layouts.dashboard')

@section('title','Attendance Update')


@section('style')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Attendance Update</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Attendance Update</h3>
                            </div>

                            <form action="{{ route('attendance-update-by-date',$attendance->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">User <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name"  value="{{ $attendance->user->name }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="check_in_out_date">Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control datepicker" name="check_in_out_date" id="check_in_out_date"  value="{{ $attendance->check_in_out_date }}">
                                                @error('check_in_out_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="check_in">Check In <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control " name="check_in" id="check_in"  value="{{ $attendance->check_in }}">
                                                @error('check_in')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="check_out">Check Out <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control " name="check_out" id="check_out"  value="{{ $attendance->check_out }}">
                                                @error('check_out')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control select2" id="status">
                                                    @foreach(\App\Constants\AttendanceStatus::ATTENDANCE_STATUS as $status)
                                                        <option {{ $attendance->status === $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i
                                            class="fas fa-check"></i> Update
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                            class="fas fa-arrow-left"></i> Back</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @include('layouts.assets.delete-script')
@endsection
