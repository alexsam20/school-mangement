@extends('layouts.app')

@section('style')
    <style type="text/css">
        .fc-daygrid-event {
            white-space: normal;
        }
    </style>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Calendar</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12">
                        <div class="col-md-12" id="calendar"></div>
                    </div>
                    <!--/.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('script')
    <script src="{{ url('dist/fullcalendar/index.global.js') }}"></script>
    <script type="text/javascript">
        const events = [];
        @foreach($getClassTimetable as $record)
                events.push({
                    title: 'Class : {{ $record->class_name }} - {{ $record->subject_name }}',
                    daysOfWeek: [{{ $record->fullcalendar_day }}],
                    startTime: '{{ $record->start_time }}',
                    endTime: '{{ $record->end_time }}',
                });
        @endforeach

        @foreach($getExamTimetable as $record)
                events.push({
                    title: 'Exam : {{ $record->class_name }} - {{ $record->subject_name }} - ({{ date('h:i A', strtotime($record->start_time)) }} to {{ date('h:i A', strtotime($record->end_time)) }})',
                    start: '{{ $record->exam_date }}',
                    end: '{{ $record->exam_date }}',
                    color: 'rgb(248,62,62)',
                    url: '{{ url('teacher/my_exam_timetable') }}',
                });
        @endforeach

        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: '<?php echo date('Y-m-d') ?>',
            navLinks: true,
            editable: false,
            events: events,
            initialView: 'dayGridMonth',
        });

        calendar.render();

    </script>
@endsection
