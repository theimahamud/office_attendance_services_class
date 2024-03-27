@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Settings Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Settings Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ \App\Models\Settings::get('title') }}" id="title" placeholder="Enter title">
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="company_email">Company Email</label>
                                                    <input type="email" class="form-control" name="company_email" value="{{ \App\Models\Settings::get('company_email') }}" id="company_email" placeholder="Enter company email">
                                                    @error('company_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="check_in">Check In Time</label>
                                                    <input type="time" class="form-control" name="check_in" value="{{ \App\Models\Settings::get('check_in') }}" id="check_in" placeholder="Enter check in time" autocomplete="off">
                                                    @error('check_in')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="check_out">Check Out Time</label>
                                                    <input type="time" class="form-control" name="check_out" value="{{ \App\Models\Settings::get('check_out') }}" id="check_out" placeholder="Enter check out time" autocomplete="off">
                                                    @error('check_out')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="grace_time">Grace Time</label>
                                                    <input type="number" class="form-control" name="grace_time" value="{{ \App\Models\Settings::get('grace_time') }}" id="grace_time" placeholder="Enter grace time" autocomplete="off">
                                                    @error('grace_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="ip_address">IP Address ( Current IP {{$_SERVER['REMOTE_ADDR']}} )</label>
                                                    <select class="form-control select2" multiple name="ip_address[]" id="ip_address">
                                                        @if( unserialize(\App\Models\Settings::get('ip_address')))
                                                            @foreach(unserialize(\App\Models\Settings::get('ip_address')) as $ip)
                                                              <option value="{{ $ip }}" selected>{{ $ip }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('ip_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="working_days">Working Days</label>
                                                    <select class="form-control select2" multiple name="working_days[]" id="working_days">
                                                        <option value="" disabled>Select One</option>
                                                        @php
                                                            $workingDaysSetting = unserialize(App\Models\Settings::get('working_days'));
                                                        @endphp
                                                        @foreach(\App\Constants\WorkingDays::WORKINGDAYS as $working_days)
                                                            <option {{ $workingDaysSetting && in_array($working_days, $workingDaysSetting) ? 'selected' : '' }} value="{{ $working_days }}">{{ ucwords($working_days) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('working_days')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="leave_request_approved_comment">Leave Request Approved Comment</label>
                                                    <textarea name="leave_request_approved_comment" class="form-control" id="leave_request_approved_comment" cols="30" rows="3">{{ \App\Models\Settings::get('leave_request_approved_comment') }}</textarea>
                                                    @error('leave_request_approved_comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="leave_request_rejected_comment">Leave Request Rejected Comment</label>
                                                    <textarea name="leave_request_rejected_comment" class="form-control" id="leave_request_rejected_comment" cols="30" rows="3">{{ \App\Models\Settings::get('leave_request_rejected_comment') }}</textarea>
                                                    @error('leave_request_rejected_comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="image">Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-upload-input" name="logo" id="logo">
                                                        <label class="custom-file-label" for="logo">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="preview_image">
                                                    <img class="image-preview" src="{{ asset($logoUrl ?? \App\Models\Settings::PLACEHOLDER_IMAGE_PATH) }}" alt="logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-check"></i> Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</a>
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

@endsection
