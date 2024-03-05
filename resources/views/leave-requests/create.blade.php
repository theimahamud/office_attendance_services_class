@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Leave Request Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Leave Request Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Leave Request Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('leave-request.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="leave_policy_id">Leave Type <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="leave_policy_id"
                                                            id="leave_policy_id">
                                                        <option value="" selected disabled>Select One</option>
                                                        @foreach($leavePolicies as $leave_policy)
                                                            <option
                                                                {{ old('leave_policy_id') == $leave_policy->id ? 'selected':'' }} value="{{ $leave_policy->id }}">{{ $leave_policy->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('leave_policy_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="start_date">Start date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="start_date"
                                                           value="{{ old('start_date') }}" id="start_date"
                                                           autocomplete="off" placeholder="Start date">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control datepicker" name="end_date"
                                                       value="{{ old('end_date') }}" id="end_date" autocomplete="off"
                                                       placeholder="End Date">
                                                @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <span id="dateValidationError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="referred_by">Reference By</label>
                                                    <select class="form-control select2" name="referred_by"
                                                            id="referred_by">
                                                        <option value="" selected disabled>Select One</option>
                                                        @foreach($users as $user)
                                                            <option
                                                                {{ old('referred_by') == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('referred_by')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        @if(auth()->user()->isAdmin())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="user_id">Employee <span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="user_id"
                                                                id="user_id">
                                                            <option value="" selected disabled>Select One</option>
                                                            @foreach($users as $user)
                                                                <option
                                                                    {{ old('user_id') == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="leave_reason">Leave Reason <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="leave_reason" id="leave_reason"
                                                          cols="30" rows="2">{{ old('leave_reason') }}</textarea>
                                                @error('leave_reason')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-check"></i> Submit
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i
                                            class="fas fa-arrow-left"></i> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

    @include('layouts.assets.image-upload-preview-script')

    <script>
        $(document).ready(function () {
            $('#start_date, #end_date').change(function () {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($('#end_date').val());

                // Check if end date is before start date
                if (endDate < startDate) {
                    $('#dateValidationError').text('End date must be after start date.');
                    $('#submitButton').prop('disabled', true); // Disable submit button
                } else {
                    $('#dateValidationError').text('');
                    $('#submitButton').prop('disabled', false); // Enable submit button
                }
            });
        });
    </script>

@endsection
