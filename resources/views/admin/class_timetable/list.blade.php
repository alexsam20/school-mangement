@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class Timetable</h1>
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
                                <h3 class="card-title">Search Admin</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="class_id">Class Name</label>
                                            <select class="form-control getClass" name="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $class)
                                                    <option {{(request('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="subject_id">Subject Name</label>
                                            <select class="form-control getSubject" name="subject_id" required>
                                                <option value="">Select Subject</option>
                                                @if(!empty($getSubject))
                                                    @foreach($getSubject as $subject)
                                                        <option {{(request('subject_id') == $subject->subject_id) ? 'selected' : ''}} value="{{ $subject->subject_id }}">{{$subject->subject_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                            <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>

                        @if(!empty(request('class_id')) && !empty(request('subject_id')))
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Class Timetable</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($week as $day)
                                            <tr>
                                                <th>{{$day['week_name']}}</th>
                                                <td>
                                                    <input type="time" name="start_time" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="time" name="end_time" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="room_number" class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div style="text-align: center; padding: 18px 0">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
        $('.getClass').change(function () {
            var class_id = $(this).val();
            $.ajax({
                url: "{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id:class_id,
                },
                dataType: "json",
                success: function (response) {
                    $('.getSubject').html(response.html);
                },
            });
        });
    </script>
@endsection
