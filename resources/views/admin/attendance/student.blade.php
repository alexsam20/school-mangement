@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Attendance</h1>
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
                                <h3 class="card-title">Search Student Attendance</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-3">
                                            <label for="name">Class</label>
                                            <select class="form-control" name="class_id" id="getClass" required>
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $class)
                                                    <option
                                                        {{(request('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="name">Attendance Date</label>
                                            <input type="date" class="form-control" id="getAttendanceDate" name="attendance_date" value="{{ request('attendance_date') }}" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('admin/attendance/student') }}"
                                               class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                            @if(!empty(request('class_id')) && !empty(request('attendance_date')))
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Student List</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0" style="overflow: auto">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Student Name</th>
                                                    <th>Attendance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($getStudent) && !empty($getStudent->count()))
                                                @foreach($getStudent as $student)
                                                    @php
                                                        $attendance_type = '';
                                                        $getAttendance = $student->getAttendance($student->id, request('class_id'), request('attendance_date'));
                                                        if (!empty($getAttendance->attendance_type)) {
                                                            $attendance_type = $getAttendance->attendance_type;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $student->id }}</td>
                                                        <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                        <td>
                                                            <label style="margin-right: 10px">
                                                                <input value="1" type="radio" {{ ($attendance_type == 1) ? 'checked' : '' }} id="{{ $student->id }}" class="saveAttendance" name="attendance{{ $student->id }}" /> Present
                                                            </label>
                                                            <label style="margin-right: 10px">
                                                                <input value="2" type="radio" {{ ($attendance_type == 2) ? 'checked' : '' }} id="{{ $student->id }}" class="saveAttendance" name="attendance{{ $student->id }}" /> Late
                                                            </label>
                                                            <label style="margin-right: 10px">
                                                                <input value="3" type="radio" {{ ($attendance_type == 3) ? 'checked' : '' }} id="{{ $student->id }}" class="saveAttendance" name="attendance{{ $student->id }}" /> Absent
                                                            </label>
                                                            <label>
                                                                <input value="4" type="radio" {{ ($attendance_type == 4) ? 'checked' : '' }} id="{{ $student->id }}" class="saveAttendance" name="attendance{{ $student->id }}" /> Half Day
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
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

        $('.saveAttendance').change(function (e) {
            const student_id = $(this).attr('id');
            const attendance_type = $(this).val();
            const class_id = $('#getClass').val();
            const attendance_date = $('#getAttendanceDate').val();

            $.ajax({
                type: 'post',
                url: '{{ url('admin/attendance/student/save') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    student_id: student_id,
                    attendance_type: attendance_type,
                    class_id: class_id,
                    attendance_date: attendance_date,
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                }
            });
        });

    </script>
@endsection
