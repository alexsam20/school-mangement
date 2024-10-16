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
                        <h1>My Calendar <span style="color: blue">( {{ $getStudent->name }} {{ $getStudent->last_name }} )</span></h1>
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

        @foreach($getRecordsTimeTbl as $record)
        @foreach($record['week'] as $day)
        events.push({
            title: '{{ $record['name'] }}',
            daysOfWeek: [{{ $day['fullcalendar_day'] }}],
            startTime: '{{ $day['start_time'] }}',
            endTime: '{{ $day['end_time'] }}',
        });
        @endforeach
        @endforeach

        @foreach($getRecordsExamTimeTbl as $record)
        @foreach($record['exam'] as $exam)
        events.push({
            title: '{{ $record['name'] }} - {{ $exam['subject_name'] }} - ({{ date('h:i A', strtotime($exam['start_time'])) }} to {{ date('h:i A', strtotime($exam['end_time'])) }})',
            start: '{{ $exam['exam_date'] }}',
            end: '{{ $exam['exam_date'] }}',
            color: '#BE17BEFF',
        });
        @endforeach
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
