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
                <div class="row">
                    <div class="col-sm-12">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {!! session('error') !!}
                            </div>
                        @endif
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
                            <form action="{{ route('holiday.update',$holiday->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="title">Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title',$holiday->title) }}" id="title" placeholder="Enter title">
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
                                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date',$holiday->start_date) }}" id="start_date" autocomplete="off" placeholder="Start date">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control datepicker" name="end_date" value="{{ old('end_date',$holiday->end_date) }}" id="end_date" autocomplete="off" placeholder="End Date">
                                                @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option {{ old('status',$holiday->status) == 'Draft' ? 'selected' : '' }} value="Draft">Draft</option>
                                                    <option {{ old('status',$holiday->status) == 'Published' ? 'selected' : '' }} value="Published">Published</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="2">{{ old('description',$holiday->description) }}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-upload-input" name="image" id="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <div class="p-3">
                                                        <img class="rounded img-fluid image-preview" src="{{ old('image', asset('assets/admin/dist/img/placeholder.jpeg')) }}" width="80%" alt="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
