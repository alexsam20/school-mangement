@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Exam Timetable</h1>
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
                            @if(!empty($item['exam']))
                            <h2 style="font-size: 32px; margin-bottom: 15px;">Class : <span style="color: #253B76">{{ $item['class_name'] }}</span></h2>
                            @foreach($item['exam'] as $exam)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Exam name : <strong>{{ $exam['exam_name'] }}</strong></h3>
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
                                            @foreach($exam['subject'] as $subject)
                                                <tr>
                                                    <th>{{$subject['subject_name']}}</th>
                                                    <td>{{ date('l', strtotime($subject['exam_date'])) }}</td>
                                                    <td>{{ date('M d, Y', strtotime($subject['exam_date'])) }}</td>
                                                    <td>{{ date('H:i A', strtotime($subject['start_time'])) }}</td>
                                                    <td>{{ date('H:i A', strtotime($subject['end_time'])) }}</td>
                                                    <td>{{$subject['room_number']}}</td>
                                                    <td>{{$subject['full_marks']}}</td>
                                                    <td>{{$subject['passing_marks']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            @endforeach
                            @endif
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
