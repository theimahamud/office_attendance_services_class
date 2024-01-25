@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Form</li>
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
                                <h3 class="card-title">User Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="Enter username">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="birth_date">Birth date <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="birth_date" id="birth_date" placeholder="Birth date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hire_date">Hire Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="hire_date" id="hire_date" placeholder="Hire Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control select2" name="role" id="role">
                                                    <option value="{{ \App\Constants\Role::USER }}" selected="selected" >User</option>
                                                    <option value="{{ \App\Constants\Role::ADMIN }}" >Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="{{ \App\Constants\Status::ACTIVE }}" selected="selected" >Active</option>
                                                    <option value="{{ \App\Constants\Status::INACTIVE }}" >Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="gender">Gender</label>
                                                <select class="form-control select2" name="gender" id="gender" >
                                                    <option value="" selected disabled>Select One</option>
                                                    <option value="{{ \App\Constants\Gender::MALE }}" >Male</option>
                                                    <option value="{{ \App\Constants\Gender::FEMALE }}" >Male</option>
                                                    <option value="{{ \App\Constants\Gender::OTHER }}" >Male</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="marital_status">Marital Status</label>
                                                <select class="form-control select2" name="marital_status" id="marital_status">
                                                    <option value="" selected disabled>Select One</option>
                                                    <option value="{{ \App\Constants\MaritalStatus::SINGLE }}">Active</option>
                                                    <option value="{{ \App\Constants\MaritalStatus::MARRIED }}">Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select class="form-control select2" name="type" id="type">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach(\App\Constants\Type::types as $type)
                                                        <option value="{{ $type }}">{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="blood_group">Blood Group</label>
                                                <select class="form-control select2" name="blood_group" id="blood_group">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach(\App\Constants\BloodGroup::blood_group as $b_group)
                                                        <option value="{{ $b_group }}">{{ $b_group }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department_id">Department</label>
                                                <select class="form-control select2" name="department_id" id="department_id">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="designation_id">Designation</label>
                                                <select class="form-control select2" name="designation_id" id="designation_id">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="country_id">Country</label>
                                                <select class="form-control select2" name="country_id" id="country_id">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-upload-input" id="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                                <div class="p-3">
                                                    <img class="rounded img-fluid image-preview" src="{{ asset('assets/admin/dist/img/placeholder.jpeg') }}" width="100%" height="300px" alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
