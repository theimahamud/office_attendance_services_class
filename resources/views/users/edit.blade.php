@extends('layouts.dashboard')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Edit Form</h1>
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
                            <form action="{{ route('users.update',$user) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{ old('name',$user->name) }}" id="name"
                                                           placeholder="Enter name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @if(auth()->user()->isAdmin())
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="username">Username <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="username"
                                                           value="{{ old('username',$user->username) }}" id="username"
                                                           placeholder="Enter username">
                                                    @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email"
                                                           value="{{ old('email',$user->email) }}" id="email"
                                                           placeholder="Enter email">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" name="password"
                                                           id="password" placeholder="Enter password">
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="hire_date">Hire Date <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="hire_date"
                                                           value="{{ old('hire_date',$user->hire_date) }}"
                                                           id="hire_date" autocomplete="off" placeholder="Hire Date">
                                                    @error('hire_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="department_id">Department <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="department_id"
                                                            id="department_id">
                                                        @foreach($departments as $department)
                                                            <option
                                                                {{ old('department_id',$department->id) == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="designation_id">Designation <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="designation_id"
                                                            id="designation_id">
                                                        @foreach($designations as $designation)
                                                            <option
                                                                {{ old('designation_id',$designation->id) == $designation->id ? 'selected' : '' }} value="{{ $designation->id }}">{{ $designation->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="role">Role <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="role" id="role">
                                                        @foreach(\App\Constants\Role::roles as $role)
                                                            <option
                                                                {{ old('role',$user->role) == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <select class="form-control select2" name="type" id="type">
                                                        <option value="" selected disabled>Select One</option>
                                                        @foreach(\App\Constants\Type::types as $type)
                                                            <option
                                                                {{ old('type',$user->type) == $type ? 'selected' : '' }} value="{{ $type }}">{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control select2" name="status" id="status">
                                                        @foreach(\App\Constants\Status::status as $status)
                                                            <option
                                                                {{ old('status',$user->status) == $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="birth_date">Birth date <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker" name="birth_date"
                                                           value="{{ old('birth_date',$user->birth_date) }}"
                                                           id="birth_date" autocomplete="off" placeholder="Birth date">
                                                    @error('birth_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                       value="{{ old('phone',$user->phone) }}" id="phone"
                                                       placeholder="Phone">
                                                @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                       value="{{ old('address',$user->address) }}" id="address"
                                                       placeholder="Address">
                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control select2" name="gender" id="gender">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach(\App\Constants\Gender::gender as $gender)
                                                        <option
                                                            {{ old('gender',$user->gender) == $gender ? 'selected' : '' }} value="{{ $gender }}">{{ $gender }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="marital_status">Marital Status</label>
                                                <select class="form-control select2" name="marital_status"
                                                        id="marital_status">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach(\App\Constants\MaritalStatus::marital_status as $marital_status)
                                                        <option
                                                            {{ old('marital_status',$user->marital_status) == $marital_status ? 'selected' : '' }} value="{{ $marital_status }}">{{ $marital_status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('marital_status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="blood_group">Blood Group</label>
                                                <select class="form-control select2" name="blood_group"
                                                        id="blood_group">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach(\App\Constants\BloodGroup::blood_group as $b_group)
                                                        <option
                                                            {{ old('blood_group',$user->blood_group) == $b_group ? 'selected' : '' }} value="{{ $b_group }}">{{ $b_group }}</option>
                                                    @endforeach
                                                </select>
                                                @error('blood_group')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country_id">Country</label>
                                                <select class="form-control select2" name="country_id" id="country_id">
                                                    <option value="" selected disabled>Select One</option>
                                                    @foreach($countries as $country)
                                                        <option
                                                            {{ old('country_id',$user->country_id) == $country->id ? 'selected' : '' }}  value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="image">
                                                    Image
                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image-upload-input"
                                                               name="image" id="image" accept="image/*">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="preview_image text-center">
                                                    @if($user->image_url)
                                                        <img class="image-preview" src="{{ asset($user->image_url) }}"  alt="image">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update
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

@endsection
