@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Attendance <span style="color: blue">({{ $getStudent->name }} {{ $getStudent->last_name }}) (Total: {{ $getRecords->total() }})</span></h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search My Attendance</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-2">
                                            <label for="class_id">Class</label>
                                            <select class="form-control" name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $class)
                                                    <option
                                                        {{(request('class_id') == $class->class_id) ? 'selected' : ''}} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="attendance_type">Attendance Type</label>
                                            <select class="form-control" name="attendance_type">
                                                <option value="">Select</option>
                                                <option
                                                    {{(request('attendance_type') == 1) ? 'selected' : ''}} value="1">
                                                    Present
                                                </option>
                                                <option
                                                    {{(request('attendance_type') == 2) ? 'selected' : ''}} value="2">
                                                    Late
                                                </option>
                                                <option
                                                    {{(request('attendance_type') == 3) ? 'selected' : ''}} value="3">
                                                    Absent
                                                </option>
                                                <option
                                                    {{(request('attendance_type') == 4) ? 'selected' : ''}} value="4">
                                                    Half Day
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="start_attendance_date">Start Attendance Date</label>
                                            <input type="date" class="form-control" name="start_attendance_date"
                                                   value="{{ request('start_attendance_date') }}">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="end_attendance_date">End Attendance Date</label>
                                            <input type="date" class="form-control" name="end_attendance_date"
                                                   value="{{ request('end_attendance_date') }}">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">
                                                Search
                                            </button>
                                            <a href="{{ url('parent/my_student/attendance/' . $getStudent->id) }}"
                                               class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Attendance</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Attendance Type</th>
                                        <th>Attendance Date</th>
                                        <th>Created Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($getRecords))
                                        @forelse($getRecords as $record)
                                            <tr>
                                                <td>{{ $record->class_name }}</td>
                                                <td>
                                                    @if($record->attendance_type == 1)
                                                        Present
                                                    @elseif($record->attendance_type == 2)
                                                        Late
                                                    @elseif($record->attendance_type == 3)
                                                        Absent
                                                    @elseif($record->attendance_type == 4)
                                                        Half Day
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($record->attendance_date)) }}</td>
                                                <td>{{ date('d-m-Y H:i:s', strtotime($record->created_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Record Not Found</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="100%">Record Not Found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                @if(!empty($getRecords))
                                    <div style="padding: 10px 10px 0 10px; float: right;">
                                        {!! $getRecords->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div>
                                @endif
                            </div>
                        </div>

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

    </script>
@endsection
