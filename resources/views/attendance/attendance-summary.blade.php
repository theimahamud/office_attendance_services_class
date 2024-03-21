@extends('layouts.dashboard')

@section('title','Attendance Summary')


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
                        <h1>Attendance Search</h1>
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Attendance Summary</h3>
                            </div>

                            <form action="{{ route('attendance-summary') }}" method="GET" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="user_id">User <span class="text-danger">*</span></label>
                                                @if($currentUser->isAdmin())
                                                    <select class="form-control select2" name="user_id" id="user_id"
                                                            required>
                                                        <option value="" selected disabled>Select User</option>
                                                        @foreach($users as $user)
                                                            <option
                                                                {{ request('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="text" class="form-control" readonly name="name"
                                                           value="{{ $users->name }}" required>
                                                    <input type=hidden readonly name="user_id" value="{{ $users->id }}">
                                                @endif
                                                @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="year">Year <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="year" id="year" required>
                                                    @foreach($years as $year)
                                                        <option
                                                            {{ request('year') == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="month">Month <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="month" id="month" required>
                                                    @for ($month = 1; $month <= 12; $month++)
                                                        <option
                                                            {{ (request('month') ?? date('n')) == $month ? 'selected' : '' }} value="{{ $month }}">
                                                            {{ date("F", mktime(0, 0, 0, $month, 1)) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i
                                            class="fas fa-check"></i> Search
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
        <section class="content mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-info ">
                            <div class="card-header">
                                <h3 class="card-title text-center"><strong>Attendance
                                        Summary {{ isset($monthName) ? date('F', mktime(0, 0, 0, $monthName, 1)) : \Carbon\Carbon::now()->monthName }} {{ $year ?? \Carbon\Carbon::now()->format('Y')  }}</strong>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table user_info_attendance_report">
                                    <tr>
                                        <td><strong>Total Working Days</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalWorkingDays }}</td>
                                        <td><strong>Total Work Time</strong></td>
                                        <td>:</td>
                                        <td>{{ floor($totalWorkTime / 3600) }}
                                            h {{ floor(($totalWorkTime % 3600) / 60) }} m
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Average Check In Time</strong></td>
                                        <td>:</td>
                                        <td>{{ $averageCheckInTime }}</td>
                                        <td><strong>Average Check Out Time</strong></td>
                                        <td>:</td>
                                        <td>{{ $averageCheckOutTime }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Present</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalPresent }}</td>
                                        <td><strong>Total Absent</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalAbsent }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Holiday</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalHoliday }}</td>
                                        <td><strong>Total Weekend</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalWeekend }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Leave</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalLeave }}</td>
                                        <td><strong>Total Early Left</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalEarlyLeft }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total In Time</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalInTime }}</td>
                                        <td><strong>Total Late</strong></td>
                                        <td>:</td>
                                        <td>{{ $totalLate }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title text-center"><strong>Attendance
                                        Summary {{ isset($monthName) ? date('F', mktime(0, 0, 0, $monthName, 1)) : \Carbon\Carbon::now()->monthName }} {{ $year ?? \Carbon\Carbon::now()->format('Y')  }}</strong>
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped">

                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Status</th>
                                        <th>Work Hour</th>
                                        @if($currentUser->isAdmin())
                                            <th>Action</th>
                                        @endif
                                    </tr>

                                    <tbody>
                                    @foreach($attendance_summary as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->check_in_out_date }}</td>
                                            <td style="{{ isset($attendance->check_in) && strtotime($attendance->check_in) > strtotime(\App\Models\Settings::get('check_in')) ? 'color: red;' : '' }}">
                                                {{ isset($attendance->check_in) ? date('h:i A', strtotime($attendance->check_in)) : 'Null' }}
                                            </td>
                                            <td style="{{ isset($attendance->check_out) && strtotime($attendance->check_out) < strtotime(\App\Models\Settings::get('check_out')) ? 'color: red;' : '' }}">
                                                {{ isset($attendance->check_out) ? date('h:i A', strtotime($attendance->check_out)) : 'Null' }}
                                            </td>

                                            <td>
                                                <span class="badge
                                                    @if($attendance->status === \App\Constants\AttendanceStatus::PRESENT) badge-success
                                                    @elseif($attendance->status === \App\Constants\AttendanceStatus::ABSENT) badge-danger
                                                    @elseif($attendance->status === \App\Constants\AttendanceStatus::HOLIDAY) badge-info
                                                    @elseif($attendance->status === \App\Constants\AttendanceStatus::LEAVE) badge-primary
                                                    @elseif($attendance->status === \App\Constants\AttendanceStatus::WEEKEND) badge-secondary
                                                    @else badge-dark
                                                    @endif p-2">
                                                    {{ $attendance->status }}
                                                </span>
                                            </td>

                                            <td>
                                                @if(isset($attendance->check_in) && isset($attendance->check_out))
                                                    {{ \Carbon\Carbon::parse($attendance->check_in)->diff(\Carbon\Carbon::parse($attendance->check_out))->format('%Hh %Im') }}
                                                @else
                                                    Null
                                                @endif
                                            </td>
                                            @if($currentUser->isAdmin())
                                                <td>
                                                    <a href="{{ route('attendance-update-date-wise',$attendance->id) }}"
                                                       class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <button
                                                        data-delete-route="{{ route('attendance.destroy', $attendance->id) }}"
                                                        class="btn btn-danger btn-sm delete-item-btn"><i
                                                            class="fas fa-trash"></i></button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

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
