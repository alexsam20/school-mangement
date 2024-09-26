@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent List (Total: {{ $getRecords->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
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
                                <h3 class="card-title">Search Parent</h3>
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
                                            <label for="occupation">Occupation</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('occupation') }}"
                                                   name="occupation"
                                                   placeholder="Enter Occupation">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('address') }}"
                                                   name="address"
                                                   placeholder="Enter Address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('mobile_number') }}"
                                                   name="mobile_number"
                                                   placeholder="Enter Mobile Phone Number">
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
                                            <a href="{{ url('admin/parent/list') }}" class="btn btn-success"
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
                                <h3 class="card-title">Parent List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Occupation</th>
                                        <th>Mobile Number</th>
                                        <th>Address</th>
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
                                            <td>{{$record->name}} {{$record->last_name}}</td>
                                            <td>{{$record->email}}</td>
                                            <td>{{$record->gender}}</td>
                                            <td>{{$record->occupation}}</td>
                                            <td>{{$record->mobile_number}}</td>
                                            <td>{{$record->address}}</td>
                                            <td>{{($record->status == 0) ? 'Active' : 'Inactive'}}</td>
                                            <td>{{date('M d, Y H:i A', strtotime($record->created_at))}}</td>
                                            <td>
                                                <a href="{{ url('admin/parent/edit/' . $record->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/parent/delete/' . $record->id) }}"
                                                   class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">
                                    {!! $getRecords->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
