@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Leave Policy Edit Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Leave Policy Form</li>
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
                                <h3 class="card-title">Leave Policy Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('leave-policy.update',$leavepolicy->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="title">Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title',$leavepolicy->title) }}" id="title" placeholder="Enter title">
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date',$leavepolicy->start_date) }}" id="start_date" autocomplete="off" placeholder="Start date">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control datepicker" name="end_date" value="{{ old('end_date',$leavepolicy->end_date) }}" id="end_date" autocomplete="off" placeholder="End Date">
                                                @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="maximum_in_year">Maximum In Year<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="maximum_in_year" value="{{ old('maximum_in_year',$leavepolicy->maximum_in_year) }}" id="maximum_in_year" placeholder="Maximum in year">
                                                    @error('maximum_in_year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="status" id="status">
                                                    @foreach(\App\Constants\Status::status as $status)
                                                        <option {{ old('status',$leavepolicy->status) == $status ? 'selected' : '' }} value="{{ $status }}" >{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="2">{{ old('description',$leavepolicy->description) }}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update</button>
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
