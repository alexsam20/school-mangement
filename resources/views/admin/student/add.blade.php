@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Student</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form method="post" action="" enctype="multipart/form-data">
                                {{ @csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="First name">First Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Enter First name">
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Last name">Last Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Enter Last name">
                                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Admission Name">Admission Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('admission_name') }}" name="admission_name" required placeholder="Enter Admission Name">
                                            <div style="color: red">{{ $errors->first('admission_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Roll Number">Roll Number <span style="color: red"></span></label>
                                            <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" placeholder="Enter Roll Number">
                                            <div style="color: red">{{ $errors->first('roll_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Class">Class <span style="color: red">*</span></label>
                                            <select class="form-control" required name="class_id">
                                                <option value="">Select class</option>
                                                @foreach($getClass as $class)
                                                    <option {{ (old('class_id') == $class->id ? 'selected' : '') }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select><div style="color: red">{{ $errors->first('roll_number') }}</div>
                                            <div style="color: red">{{ $errors->first('roll_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Gender">Gender <span style="color: red">*</span></label>
                                            <select class="form-control" required name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ (old('gender') == 'Male' ? 'selected' : '') }} value="Male">Male</option>
                                                <option {{ (old('gender') == 'Female' ? 'selected' : '') }} value="Female">Female</option>
                                                <option {{ (old('gender') == '0ther' ? 'selected' : '') }} value="0ther">0ther</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('gender') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Date Of Birth">Date Of Birth <span style="color: red">*</span></label>
                                            <input type="date" class="form-control" value="{{ old('date_of_birth') }}" name="date_of_birth">
                                            <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Caste">Caste</label>
                                            <input type="text" class="form-control" value="{{ old('caste') }}" name="caste" placeholder="Enter Caste">
                                            <div style="color: red">{{ $errors->first('caste') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Region">Religion</label>
                                            <input type="text" class="form-control" value="{{ old('region') }}" name="region" placeholder="Enter Region">
                                            <div style="color: red">{{ $errors->first('region') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Mobile Number">Mobile Number</label>
                                            <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" placeholder="Enter Mobile Number">
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Admission Date">Admission Date <span style="color: red">*</span></label>
                                            <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date">
                                            <div style="color: red">{{ $errors->first('admission_date') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Profile Pic">Profile Pic</label>
                                            <input type="file" class="form-control" name="profile_pic">
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Blood Group">Blood Group <span style="color: red"></span></label>
                                            <input type="text" class="form-control" value="{{ old('blood_group') }}" name="blood_group" placeholder="Enter Blood Group">
                                            <div style="color: red">{{ $errors->first('blood_group') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Height">Height <span style="color: red"></span></label>
                                            <input type="text" class="form-control" value="{{ old('height') }}" name="height" placeholder="Enter Height">
                                            <div style="color: red">{{ $errors->first('height') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Weight">Weight <span style="color: red"></span></label>
                                            <input type="text" class="form-control" value="{{ old('weight') }}" name="weight" placeholder="Enter Weight">
                                            <div style="color: red">{{ $errors->first('weight') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Status">Status <span style="color: red">*</span></label>
                                            <select class="form-control" required name="status">
                                                <option value="">Select Status</option>
                                                <option {{ (old('status') == 0 ? 'selected' : '') }} value="0">Active</option>
                                                <option {{ (old('status') == 1 ? 'selected' : '') }} value="1">Inactive</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Enter email">
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span style="color: red">*</span></label>
                                        <input type="password" class="form-control" name="password" required placeholder="Password">
                                        <div style="color: red">{{ $errors->first('password') }}</div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
