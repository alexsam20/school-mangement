@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List (Total: {{ $getRecords->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Teacher</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Teacher</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('name') }}"
                                                   name="name"
                                                   placeholder="Enter Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('last_name') }}"
                                                   name="last_name"
                                                   placeholder="Enter Last Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('email') }}"
                                                   name="email"
                                                   placeholder="Enter email">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ (\Illuminate\Support\Facades\Request::get('gender') == 'Male' ? 'selected' : '') }} value="Male">Male</option>
                                                <option {{ (\Illuminate\Support\Facades\Request::get('gender') == 'Female' ? 'selected' : '') }} value="Female">Female</option>
                                                <option {{ (\Illuminate\Support\Facades\Request::get('gender') == '0ther' ? 'selected' : '') }} value="0ther">0ther</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('mobile_number') }}"
                                                   name="mobile_number"
                                                   placeholder="Enter Mobile Phone Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="marital_status">Marital Status</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('marital_status') }}"
                                                   name="marital_status"
                                                   placeholder="Enter Marital Status">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="address">Current Address</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('address') }}"
                                                   name="address"
                                                   placeholder="Enter Current Address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                <option {{ (\Illuminate\Support\Facades\Request::get('status') == 100 ? 'selected' : '') }} value="100">Active</option>
                                                <option {{ (\Illuminate\Support\Facades\Request::get('status') == 1 ? 'selected' : '') }} value="1">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="date_of_joining">Date Of Joining</label>
                                            <input type="date" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('date_of_joining') }}"
                                                   name="date_of_joining"
                                                   placeholder="Enter Date Of Joining">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="created_at">Created Date</label>
                                            <input type="date" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('created_at') }}"
                                                   name="created_at"
                                                   placeholder="Enter date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('admin/teacher/list') }}" class="btn btn-success"
                                               style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Teacher List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th>Teacher Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Date Of Joining</th>
                                        <th>Mobile Number</th>
                                        <th>Marital Status</th>
                                        <th>Current Address</th>
                                        <th>Permanent Address</th>
                                        <th>Qualification</th>
                                        <th>Work Experience</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecords as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>
                                                @if(!empty($record->getProfile()))
                                                    <img src="{{$record->getProfile()}}"
                                                         style="width: 50px; height: 50px; border-radius: 50px"/>
                                                @endif
                                            </td>
                                            <td>{{$record->name}}</td>
                                            <td>{{$record->email}}</td>
                                            <td>{{$record->gender}}</td>
                                            <td>
                                                @if(!empty($record->date_of_birth))
                                                    {{date('d-m-Y', strtotime($record->date_of_birth))}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($record->admission_date))
                                                    {{date('d-m-Y', strtotime($record->admission_date))}}
                                                @endif
                                            </td>
                                            <td>{{$record->mobile_number}}</td>
                                            <td>{{$record->marital_status}}</td>
                                            <td>{{$record->address}}</td>
                                            <td>{{$record->permanent_address}}</td>
                                            <td>{{$record->qualification}}</td>
                                            <td>{{$record->work_experience}}</td>
                                            <td>{{$record->note}}</td>
                                            <td>{{($record->status == 0) ? 'Active' : 'Inactive'}}</td>
                                            <td>{{date('d m Y H i', strtotime($record->created_at))}}</td>
                                            <td style="min-width: 150px">
                                                <a href="{{ url('admin/teacher/edit/' . $record->id) }}"
                                                   class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/teacher/delete/' . $record->id) }}"
                                                   class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">
{{--                                    {!! $getRecords->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}--}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
