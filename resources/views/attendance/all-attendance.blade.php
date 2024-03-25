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
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">All Attendance</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('all-absent-present-attendance') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row justify-content-center align-items-center text-center">
                                        <div class="col-md-4">
                                            <!-- radio -->
                                            <div class="form-group clearfix">
                                                <div class="d-inline">
                                                    <input required type="text" class="form-control datepicker" id="date" name="check_in_out_date" placeholder="Attendance date" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- radio -->
                                            <div class="form-group clearfix">
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" id="present" name="status" value="Present" checked="">
                                                    <label for="present">
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <label for="present">
                                                        All Present
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="icheck-danger d-inline">
                                                    <input type="radio" id="absent" name="status" value="Absent">
                                                    <label for="absent">
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <label for="absent">
                                                        All Absent
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary float-right">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">All Absent</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('individual-attendance-update') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Profile</th>
                                                <th>Date</th>
                                                <th>CheckIn</th>
                                                <th>CheckOut</th>
                                                <th>Status</th>
                                            </tr>
                                            <tbody>
                                            @foreach($absent_attendance as $absent)
                                                <input type="hidden" name="attendance_id[]" value="{{$absent->id}}">
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center align-content-center">
                                                        <div class="profile_img">
                                                            @if($absent->user->image_url)
                                                               <img src="{{ asset($absent->user->image_url) }}" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="ml-2">
                                                            {{ $absent->user->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="check_in_out_date[]" class="form-control datepicker" value="{{ $absent->check_in_out_date }}" placeholder="Choose date">
                                                </td>
                                                <td>
                                                    <input type="time" name="check_in[]"  class="form-control" value="{{ $absent->check_in }}" placeholder="Choose check in">
                                                </td>
                                                <td>
                                                    <input type="time" name="check_out[]" class="form-control" value="{{ $absent->check_out }}" placeholder="Choose check out">
                                                </td>
                                                <td>
                                                    <select name="status[]" id="status" class="form-control">
                                                        @foreach(\App\Constants\AttendanceStatus::ATTENDANCE_STATUS as $attendance_status )
                                                            <option {{ $absent->status == $attendance_status ? 'selected':''  }} value="{{ $attendance_status }}">{{ $attendance_status }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @if(filled($absent_attendance))
                                        <div class="">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content mt-4">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">All Present</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="col-sm-12 table-responsive">
                                    <table class="table table-bordered table-striped" id="datatables">
                                       <thead>
                                       <tr>
                                           <th>Profile</th>
                                           <th>Date</th>
                                           <th>CheckIn</th>
                                           <th>CheckOut</th>
                                           <th>Status</th>
                                       </tr>
                                       </thead>
                                        <tbody>
                                        @foreach($present_attendance as $present)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center align-content-center">
                                                        <div class="profile_img">
                                                            @if($present->user->image_url)
                                                                <img src="{{ asset($present->user->image_url) }}" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="ml-2">
                                                            {{ $present->user->name ?? ''  }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $present->check_in_out_date ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $present->check_in ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $present->check_out ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $present->status ?? '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
