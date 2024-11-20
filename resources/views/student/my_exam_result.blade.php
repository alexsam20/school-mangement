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
                                    <h3 class="card-title"><span class="badge bg-cyan">{{ $record['exam_name'] }}</span>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Class Work</th>
                                            <th>Test Work</th>
                                            <th>Home Work</th>
                                            <th>Exam Work</th>
                                            <th>Total Score</th>
                                            <th>Passing Marks</th>
                                            <th>Full Marks</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $total_score = $full_marks = $result_validation = 0; @endphp
                                        @foreach($record['subject'] as $subject)
                                            @php
                                                $total_score += $subject['total_score'];
                                                $full_marks += $subject['full_marks'];
                                            @endphp
                                            <tr>
                                                <td style="width: 300px"><strong>{{$subject['subject_name']}}</strong></td>
                                                <td>{{$subject['class_work']}}</td>
                                                <td>{{$subject['test_work']}}</td>
                                                <td>{{$subject['home_work']}}</td>
                                                <td>{{$subject['exam_work']}}</td>
                                                <td><span class="badge bg-blue">{{$subject['total_score']}}</span></td>
                                                <td><span class="badge bg-green">{{$subject['passing_marks']}}</td>
                                                <td><span class="badge bg-yellow">{{$subject['full_marks']}}</span></td>
                                                <td>
                                                    @if($subject['total_score'] >= $subject['passing_marks'])
                                                        <span class="badge bg-green">Pass</span>
                                                    @else
                                                        @php $result_validation = 1; @endphp
                                                        <span class="badge bg-danger">Fail</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">
                                                <strong>Grand Total:</strong> <span class="badge bg-gray">{{ $total_score }}/{{ $full_marks }}</span>
                                            </td>
                                            <td colspan="2">
                                                @php
                                                    $percentage = ($total_score * 100) / $full_marks;
                                                    $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                                @endphp
                                                <strong>Percentage:</strong> <span class="badge bg-gray">{{ round($percentage, 2) }}%</span>
                                            </td>
                                            <td colspan="2">
                                                <strong>Grade:</strong> <span class="badge bg-purple">{{ $getGrade }}</span>
                                            </td>
                                            <td colspan="3">
                                                <strong>Result:</strong>
                                                @if($result_validation == 0)
                                                    <span class="badge bg-green">Pass</span>
                                                @else
                                                    <span class="badge bg-danger">Fail</span>
                                                @endif
                                            </td>
                                        </tr>
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
