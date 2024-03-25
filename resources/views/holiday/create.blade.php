@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Holiday Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Holiday Form</li>
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
                                <h3 class="card-title">Holiday Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('holiday.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="title">Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" placeholder="Enter title">
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option {{ old('status') === \App\Constants\Status::DRAFT ? 'selected' : '' }} value="{{ \App\Constants\Status::DRAFT }}">{{ \App\Constants\Status::DRAFT }}</option>
                                                    <option {{ old('status') === \App\Constants\Status::PUBLISHED ? 'selected' : '' }} value="{{ \App\Constants\Status::PUBLISHED }}">{{ \App\Constants\Status::PUBLISHED }}</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date') }}" id="start_date" autocomplete="off" placeholder="Start date">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control datepicker" name="end_date" value="{{ old('end_date') }}" id="end_date" autocomplete="off" placeholder="End Date">
                                                @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <span id="dateValidationError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="3">{{ old('description') }}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-upload-input" name="image" id="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="preview_image">
                                                    <img class="image-preview" src="{{ old('image', asset(\App\Models\Holiday::PLACEHOLDER_IMAGE_PATH)) }}" alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-check"></i> Submit</button>
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
