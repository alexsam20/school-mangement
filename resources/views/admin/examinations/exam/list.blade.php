@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam List (Total: {{ $getRecords->total() }})</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/examinations/exam/add') }}" class="btn btn-primary">Add New Exam</a>
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
                            <h3 class="card-title">Search Exam</h3>
                        </div>
                        <!-- form start -->
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Exam Name</label>
                                        <input type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('name') }}" name="name"
                                               placeholder="Enter Exam Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="created_at">Date</label>
                                        <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('created_at') }}" name="created_at">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                        <a href="{{ url('admin/examinations/exam/list') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>
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
                            <h3 class="card-title">Exam List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Exam Name</th>
                                    <th>Note</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($getRecords as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->note}}</td>
                                    <td>{{$record->created_name}}</td>
                                    <td>{{date('M d, Y H:i A', strtotime($record->created_at))}}</td>
                                    <td>
                                        <a href="{{ url('admin/examinations/exam/edit/' . $record->id) }}"
                                           class="btn btn-primary">Edit</a>
                                        <a href="{{ url('admin/examinations/exam/delete/' . $record->id) }}"
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
