@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Subjects <span style="color: blue;">({{ $getUser->name }} {{ $getUser->last_name }})</span></h1>
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
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student Subjects</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecords as $record)
                                        <tr>
                                            <td>{{$record->subject_name}}</td>
                                            <td>{{$record->subjects_type}}</td>
                                            <td><a href="{{ url('parent/my_student/class_timetable/' . $record->class_id . '/' . $record->subject_id . '/' . $getUser->id) }}" class="btn btn-primary">My Class Timetable</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
