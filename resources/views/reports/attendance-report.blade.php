@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Settings Create Form</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Report</li>
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
                                <h3 class="card-title">User Report</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('report-generate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="user_id">User</label>
                                                    @if($currentUser->isAdmin())
                                                    <select class="form-control select2" name="user_id" id="user_id" required>
                                                        <option value="" selected disabled>Select User</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @else
                                                        <input type="text" class="form-control" readonly name="name" value="{{ $users->name }}" required>
                                                        <input type=hidden readonly name="user_id" value="{{ $users->id }}">
                                                    @endif

                                                    @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <select class="form-control select2" name="year" id="year" required>
                                                    @foreach($years as $year)
                                                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="month">Month</label>
                                                <select class="form-control select2" name="month" id="month" required>
                                                    @for ($month = 1; $month <= 12; $month++)
                                                        <option value="{{ $month }}" {{ $month == date('n') ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-check"></i> Report Generate</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</a>
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

    @include('layouts.assets.image-upload-preview-script')

@endsection
