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
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        @if(session('success'))--}}
{{--                            <div class="alert alert-success">--}}
{{--                                {!! session('success') !!}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        @if(session('error'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                {!! session('error') !!}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Department Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route(isset($department->id) ? 'departments.update' : 'departments.store', $department->id ?? '') }}" method="post">
                                @csrf
                                @if(isset($department->id))
                                    @method('PUT')
                                @endif

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" value="{{ old('title', $department->title ?? '') }}" id="title" placeholder="Enter title">
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="description" cols="30" rows="2">{{ $department->description ?? '' }}</textarea>
                                                @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right"> <i class="fas fa-check"></i>
                                        {{ isset($department->id) ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Department List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($departments->count() <= 0)
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/dist/img/no-result.png') }}" alt="No result">
                                <h3 class="p-6 text-center">
                                    No data found
                                </h3>
                            </div>
                        @else
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table class="table table-bordered table-striped" id="datatables">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th width="40%">Description</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($departments as $department)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $department->title ?? '' }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($department->description) ?? '' }}</td>
                                                    <td>{{ isset($department->created_at) ? getDateFormat($department->created_at) : '' }}</td>
                                                    <td>
                                                        <a href="{{ route('departments.edit',$department->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                        <button data-delete-route="{{ route('departments.destroy', $department->id) }}" class="btn btn-danger btn-sm delete-item-btn"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
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
