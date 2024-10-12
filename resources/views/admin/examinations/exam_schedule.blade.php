@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{--                        <h1>Exam List (Total: {{ $getRecords->total() }})</h1>--}}
                        <h1>Exam Schedule</h1>
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
                                <h3 class="card-title">Search Exam Schedule</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="name">Exam</label>
                                            <select class="form-control" name="exam_id" required>
                                                <option value="">Select Exam</option>
                                                @foreach($getExam as $exam)
                                                    <option {{(request('exam_id') == $exam->id) ? 'selected' : ''}} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="name">Class</label>
                                            <select class="form-control" name="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $class)
                                                    <option {{(request('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('admin/examinations/exam_schedule') }}"
                                               class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                        @include('_message')
                        @if(!empty($getRecords))
                            <form action="{{ url('admin/examinations/exam_schedule_insert') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="exam_id" value="{{ request('exam_id') }}">
                                <input type="hidden" name="class_id" value="{{ request('class_id') }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Exam Schedule</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Subject Name</th>
                                                <th>Exam Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Room Number</th>
                                                <th>Full Marks</th>
                                                <th>Passing Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($getRecords as $record)
                                                <tr>
                                                    <td>{{$record['subject_name']}}
                                                        <input type="hidden" class="form-control" value="{{$record['subject_id']}}" name="schedule[{{ $i }}][subject_id]" />
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" value="{{$record['exam_date']}}" name="schedule[{{ $i }}][exam_date]" />
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" value="{{$record['start_time']}}" name="schedule[{{ $i }}][start_time]" />
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" value="{{$record['end_time']}}" name="schedule[{{ $i }}][end_time]" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$record['room_number']}}" name="schedule[{{ $i }}][room_number]" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$record['full_marks']}}" name="schedule[{{ $i }}][full_marks]" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$record['passing_marks']}}" name="schedule[{{ $i }}][passing_marks]" />
                                                    </td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div style="text-align: center; padding: 18px 0">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </form>
                        @endif
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

