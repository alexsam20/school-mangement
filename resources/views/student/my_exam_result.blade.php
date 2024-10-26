
@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Exam Result</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach($getRecords as $record)
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><span class="badge bg-cyan">{{ $record['exam_name'] }}</span></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Class Work</th>
                                        <th>Test Work</th>
                                        <th>Home Work</th>
                                        <th>Exam Work</th>
                                        <th>Total Score</th>
                                        <th>Passing Marks</th>
                                        <th>Full Marks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($record['subject'] as $subject)
                                        <tr>
                                            <td><span class="badge bg-gradient-yellow">{{$subject['subject_name']}}</span></td>
                                            <td>{{$subject['class_work']}}</td>
                                            <td>{{$subject['test_work']}}</td>
                                            <td>{{$subject['home_work']}}</td>
                                            <td>{{$subject['exam_work']}}</td>
                                            <td><span class="badge bg-blue">{{$subject['total_score']}}</span></td>
                                            <td><span class="badge bg-green">{{$subject['passing_marks']}}</td>
                                            <td><span class="badge bg-fuchsia">{{$subject['full_marks']}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection
