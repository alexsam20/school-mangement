@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Marks Register</h1>
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
                                <h3 class="card-title">Search Marks Register</h3>
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
                                                    <option {{(request('exam_id') == $exam->exam_id) ? 'selected' : ''}} value="{{ $exam->exam_id }}">{{ $exam->exam_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="name">Class</label>
                                            <select class="form-control" name="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $class)
                                                    <option {{(request('class_id') == $class->class_id) ? 'selected' : ''}} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('teacher/marks_register') }}"
                                               class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                        @include('_message')
                        @if(!empty($getSubjects) && !empty($getSubjects->count()))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Marks Register</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0" style="overflow: auto">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            @foreach($getSubjects as $subject)
                                                <th class="text-center">
                                                    <span class="text-blue">{{ $subject->subject_name }}</span> <br/>
                                                    ({{ $subject->subject_type }} : {{ $subject->passing_marks }}
                                                    / {{ $subject->full_marks }})
                                                </th>
                                            @endforeach
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($getStudents) && !empty($getStudents->count()))
                                            @foreach($getStudents as $student)
                                                <form method="post" name="post" class="marks">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <input type="hidden" name="exam_id"
                                                           value="{{ request('exam_id') }}">
                                                    <input type="hidden" name="class_id"
                                                           value="{{ request('class_id') }}">
                                                    <tr>
                                                        <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                        @php $i = 1; $totalStudentsMarks = $totalFullMarks = $totalPassingMarks = $passFailValid = 0; @endphp
                                                        @foreach($getSubjects as $subject)
                                                            @php
                                                                $totalMark = 0;
                                                                $totalFullMarks = $totalFullMarks + $subject->full_marks;
                                                                $totalPassingMarks = $totalPassingMarks + $subject->passing_marks;
                                                                $getMark = $subject->getMark($student->id, request('exam_id'), request('class_id'), $subject->subject_id);
                                                                if (!empty($getMark)) {
                                                                    $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam_work;
                                                                }
                                                                $totalStudentsMarks = $totalStudentsMarks + $totalMark;
                                                            @endphp
                                                            <td>
                                                                <div style="margin-bottom: 10px;">
                                                                    Class Work
                                                                    <input type="hidden" name="marks[{{$i}}][full_marks]"
                                                                           value="{{ $subject->full_marks }}"/>
                                                                    <input type="hidden" name="marks[{{$i}}][passing_marks]"
                                                                           value="{{ $subject->passing_marks }}"/>
                                                                    <input type="hidden" name="marks[{{$i}}][id]"
                                                                           value="{{ $subject->id }}"/>
                                                                    <input type="hidden"
                                                                           name="marks[{{$i}}][subject_id]"
                                                                           value="{{ $subject->subject_id }}"/>
                                                                    <input type="text" name="marks[{{$i}}][class_work]"
                                                                           id="class_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                           value="{{!empty($getMark->class_work) ? $getMark->class_work : ''}}"
                                                                           style="width: 200px"
                                                                           placeholder="Enter Marks"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div style="margin-bottom: 10px;">
                                                                    Home Work
                                                                    <input type="text" name="marks[{{$i}}][home_work]"
                                                                           id="home_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                           value="{{!empty($getMark->home_work) ? $getMark->home_work : ''}}"
                                                                           style="width: 200px"
                                                                           placeholder="Enter Marks"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div style="margin-bottom: 10px;">
                                                                    Test Work
                                                                    <input type="text" name="marks[{{$i}}][test_work]"
                                                                           id="test_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                           value="{{!empty($getMark->test_work) ? $getMark->test_work : ''}}"
                                                                           style="width: 200px"
                                                                           placeholder="Enter Marks"
                                                                           class="form-control"/>
                                                                </div>
                                                                <div style="margin-bottom: 10px;">
                                                                    Exam
                                                                    <input type="text" name="marks[{{$i}}][exam_work]"
                                                                           id="exam_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                           value="{{!empty($getMark->exam_work) ? $getMark->exam_work : ''}}"
                                                                           style="width: 200px"
                                                                           placeholder="Enter Marks"
                                                                           class="form-control"/>
                                                                </div>
                                                                @if(!empty($getMark))
                                                                    <div style="margin-bottom: 10px;">
                                                                        @php $getLoopGrade = App\Models\MarksGrade::getGrade($totalMark); @endphp
                                                                        <strong>Total Mark :</strong> <span
                                                                            class="badge bg-warning">{{ $totalMark }}</span>
                                                                        <br/>
                                                                        <strong>Passing Mark :</strong> <span
                                                                            class="badge bg-success">{{ $subject->passing_marks }}</span>
                                                                        <br/>
                                                                        @if(!empty($getLoopGrade))
                                                                            <strong>Grade :</strong> <span
                                                                                class="badge bg-orange">{{ $getLoopGrade }}</span>
                                                                            <br/>
                                                                        @endif
                                                                        @if($subject->passing_marks <= $totalMark)
                                                                            <span class="badge bg-blue">Result</span> <span class="badge bg-success">Pass</span>
                                                                        @else
                                                                            <span class="badge bg-blue">Result</span> <span class="badge bg-danger">Fail</span>
                                                                            @php $passFailValid = 1; @endphp
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                                <div style="margin-bottom: 10px;">
                                                                    <button type="button"
                                                                            class="btn btn-primary saveSingleSubject"
                                                                            id="{{ $student->id }}"
                                                                            data-subject="{{ $subject->subject_id }}"
                                                                            data-exam="{{ request('exam_id') }}"
                                                                            data-schedule="{{ $subject->id }}"
                                                                            data-class="{{ request('class_id') }}">Save
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            @php $i++; @endphp
                                                        @endforeach
                                                        <td style="min-width: 200px;">
                                                            <br/>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                            @if(!empty($totalStudentsMarks))
                                                                <br/>
                                                                <br/>
                                                                <span style="margin-bottom: 5px;"
                                                                      class="badge bg-yellow">Total Subject Mark</span>
                                                                <span class="badge bg-purple">{{ $totalFullMarks }}</span>
                                                                <br/>
                                                                <span style="margin-bottom: 5px;"
                                                                      class="badge bg-yellow">Total Passing Mark</span>
                                                                <span class="badge bg-purple">{{ $totalPassingMarks }}</span>
                                                                <br/>
                                                                <span style="margin-bottom: 5px;"
                                                                      class="badge bg-yellow">Total Student Mark</span>
                                                                <span class="badge bg-purple">{{ $totalStudentsMarks }}</span>
                                                                <br />
                                                                <br />
                                                                @php
                                                                    $percentage = ($totalStudentsMarks * 100) / $totalFullMarks;
                                                                    $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                                                @endphp
                                                                <span style="margin-bottom: 5px;"
                                                                      class="badge bg-yellow">Percentage</span> <span class="badge bg-lime">{{ round($percentage, 2) }}%</span><br />
                                                                @if(!empty($getGrade))
                                                                    <span style="margin-bottom: 5px;"
                                                                          class="badge bg-yellow">Grade</span> <span
                                                                        class="badge bg-fuchsia">{{ $getGrade }}</span>
                                                                    <br />
                                                                @endif
                                                                @if($passFailValid == 0)
                                                                    <br/><span class="badge bg-blue">Result</span> <span class="badge bg-success">Pass</span>
                                                                @else
                                                                    <br/><span class="badge bg-blue">Result</span> <span class="badge bg-danger">Fail</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
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

@section('script')
    <script type="text/javascript">
        $('.marks').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ url('teacher/submit_marks_register') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                }
            });
        });

        $('.saveSingleSubject').click(function (e) {
            const student_id = $(this).attr('id');
            const subject_id = $(this).attr('data-subject');
            const exam_id = $(this).attr('data-exam');
            const class_id = $(this).attr('data-class');
            const id = $(this).attr('data-schedule');
            const class_work = $('#class_work_' + student_id + subject_id).val();
            const home_work = $('#home_work_' + student_id + subject_id).val();
            const test_work = $('#test_work_' + student_id + subject_id).val();
            const exam_work = $('#exam_work_' + student_id + subject_id).val();

            $.ajax({
                type: 'post',
                url: '{{ url('teacher/single_submit_marks_register') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id,
                    student_id: student_id,
                    subject_id: subject_id,
                    exam_id: exam_id,
                    class_id: class_id,
                    class_work: class_work,
                    home_work: home_work,
                    test_work: test_work,
                    exam_work: exam_work
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                }
            });
        });

    </script>
@endsection
