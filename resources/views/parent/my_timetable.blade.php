@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Timetable ({{ $getClass->name }} - {{ $getSubject->name }}) <span style="color: blue">({{ $getStudent->name }} {{ $getStudent->last_name }})</span></h1>
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
                                <h3 class="card-title">{{ $getClass->name }} - {{ $getSubject->name }}</h3>
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
                                    @foreach($getRecords as $record)
                                        <tr>
                                            <th>{{$record['week_name']}}</th>
                                            <td>
                                                    <span class="badge bg-success">
                                                        {{ (!empty($record['start_time'])) ? date('H:i A', strtotime($record['start_time'])) : '' }}
                                                    </span>
                                            </td>
                                            <td>
                                                    <span class="badge bg-gradient-info">
                                                        {{ (!empty($record['end_time'])) ? date('H:i A', strtotime($record['end_time'])) : '' }}
                                                    </span>
                                            </td>
                                            <td><span class="badge bg-warning">{{$record['room_number']}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
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
