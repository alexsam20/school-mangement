@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total: {{ $getRecords->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
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
                        {{--                        <div class="card">--}}
                        {{--                            <div class="card-header">--}}
                        {{--                                <h3 class="card-title">Search Student</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <!-- form start -->--}}
                        {{--                            <form method="get" action="">--}}
                        {{--                                <div class="card-body">--}}
                        {{--                                    <div class="row">--}}
                        {{--                                        <div class="form-group col-md-3">--}}
                        {{--                                            <label for="name">Name</label>--}}
                        {{--                                            <input type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('name') }}" name="name"--}}
                        {{--                                                   placeholder="Enter name">--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="form-group col-md-3">--}}
                        {{--                                            <label for="email">Email</label>--}}
                        {{--                                            <input type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('email') }}" name="email"--}}
                        {{--                                                   placeholder="Enter email">--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="form-group col-md-3">--}}
                        {{--                                            <label for="date">Date</label>--}}
                        {{--                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('date') }}" name="date"--}}
                        {{--                                                   placeholder="Enter date">--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="form-group col-md-3">--}}
                        {{--                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>--}}
                        {{--                                            <a href="{{ url('admin/student/list') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- /.card-body -->--}}
                        {{--                            </form>--}}
                        {{--                        </div>--}}
                        <!-- /.card -->
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Admission Name</th>
                                        <th>Roll Number</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Caste</th>
                                        <th>Religion</th>
                                        <th>Mobile Number</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Status</th>
                                        <th>Created At</th>
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
                                            <td>{{$record->admission_name}}</td>
                                            <td>{{$record->roll_number}}</td>
                                            <td>{{$record->class_name}}</td>
                                            <td>{{$record->gender}}</td>
                                            <td>
                                                @if(!empty($record->date_of_birth))
                                                    {{date('d m Y', strtotime($record->date_of_birth))}}
                                                @endif
                                            </td>
                                            <td>{{$record->caste}}</td>
                                            <td>{{$record->religion}}</td>
                                            <td>{{$record->mobile_number}}</td>
                                            <td>
                                                @if(!empty($record->admission_date))
                                                    {{date('d m Y', strtotime($record->admission_date))}}
                                                @endif
                                            </td>
                                            <td>{{$record->blood_group}}</td>
                                            <td>{{$record->height}}</td>
                                            <td>{{$record->weight}}</td>
                                            <td>{{($record->status == 0) ? 'Active' : 'Inactive'}}</td>
                                            <td>{{date('M d, Y H:i A', strtotime($record->created_at))}}</td>
                                            <td style="min-width: 150px">
                                                <a href="{{ url('admin/student/edit/' . $record->id) }}"
                                                   class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/student/delete/' . $record->id) }}"
                                                   class="btn btn-danger btn-sm">Delete</a>
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
