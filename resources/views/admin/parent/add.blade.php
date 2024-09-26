@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Parent</h1>
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
                                        <label for="occupation">Occupation</label>
                                        <input type="text" class="form-control" value="{{ old('occupation') }}" name="occupation" placeholder="Enter Occupation">
                                        <div style="color: red">{{ $errors->first('occupation') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Address <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('address') }}" name="address" required placeholder="Enter Address">
                                        <div style="color: red">{{ $errors->first('address') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Mobile Number">Mobile Number <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Enter Mobile Number">
                                        <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Profile Pic">Profile Pic</label>
                                        <input type="file" class="form-control" name="profile_pic">
                                        <div style="color: red">{{ $errors->first('profile_pic') }}</div>
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
