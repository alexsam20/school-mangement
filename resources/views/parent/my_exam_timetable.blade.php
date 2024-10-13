@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam Timetable <span style="color: blue">({{ $getStudent->name }} {{ $getStudent->last_name }})</span> </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <!-- general form elements -->
                        @foreach($getRecords as $item)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $item['name'] }}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Exam Day</th>
                                            <th>Exam Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                            <th>Full Marks</th>
                                            <th>Passing Marks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($item['exam'] as $exam)
                                            <tr>
                                                <th>{{$exam['subject_name']}}</th>
                                                <td>{{ date('l', strtotime($exam['exam_date'])) }}</td>
                                                <td>{{ date('M d, Y', strtotime($exam['exam_date'])) }}</td>
                                                <td>{{ date('H:i A', strtotime($exam['start_time'])) }}</td>
                                                <td>{{ date('H:i A', strtotime($exam['end_time'])) }}</td>
                                                <td>{{$exam['room_number']}}</td>
                                                <td>{{$exam['full_marks']}}</td>
                                                <td>{{$exam['passing_marks']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        @endforeach
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
