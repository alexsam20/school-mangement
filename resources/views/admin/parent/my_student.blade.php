@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent Student List ({{ $getParent->name }} {{ $getParent->last_name }})</h1>
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
                                <h3 class="card-title">Search Student</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="name">Student ID</label>
                                            <input type="text" class="form-control"
                                                   value="{{ \Illuminate\Support\Facades\Request::get('id') }}"
                                                   name="id"
                                                   placeholder="Enter Student ID">
                                        </div>
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
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('admin/parent/my-student/' . $parent_id) }}" class="btn btn-success"
                                               style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                        @include('_message')

                        @if(!empty($getSearchStudent))

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Profile Pic</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getSearchStudent as $record)
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
                                            <td>{{$record->parent_name}} {{$record->parent_last_name}}</td>
                                            <td>{{date('d.m.Y H:i:s', strtotime($record->created_at))}}</td>
                                            <td style="min-width: 150px">
                                                <a href="{{ url('admin/parent/assign_student_parent/' . $record->id . '/' . $parent_id) }}"
                                                   class="btn btn-primary btn-sm">Add Student to Parent</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Profile Pic</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $record)
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
                                            <td>{{$record->parent_name}} {{$record->parent_last_name}}</td>
                                            <td>{{date('d.m.Y H:i:s', strtotime($record->created_at))}}</td>
                                            <td style="min-width: 150px">
                                                <a href="{{ url('admin/parent/assign_student_parent_delete/' . $record->id) }}"
                                                   class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">

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
