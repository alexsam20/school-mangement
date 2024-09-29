@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Student</h1>
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
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Student</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Profile Pic</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Admission Name</th>
                                        <th>Roll Number</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Caste</th>
                                        <th>Religion</th>
                                        <th>Mobile Number</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Created Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $record)
                                        <tr>
                                            <td>
                                                @if(!empty($record->getProfile()))
                                                    <img src="{{$record->getProfile()}}"
                                                         style="width: 50px; height: 50px; border-radius: 50px"/>
                                                @endif
                                            </td>
                                            <td>{{$record->name}} {{$record->last_name}}</td>
                                            <td>{{$record->email}}</td>
                                            <td>{{$record->admission_name}}</td>
                                            <td>{{$record->roll_number}}</td>
                                            <td>{{$record->class_name}}</td>
                                            <td>{{$record->gender}}</td>
                                            <td>
                                                @if(!empty($record->date_of_birth))
                                                    {{date('d-m-Y', strtotime($record->date_of_birth))}}
                                                @endif
                                            </td>
                                            <td>{{$record->caste}}</td>
                                            <td>{{$record->religion}}</td>
                                            <td>{{$record->mobile_number}}</td>
                                            <td>
                                                @if(!empty($record->admission_date))
                                                    {{date('d m Y', strtotime($record->admission_date))}}
                                                @endif
                                            </td>
                                            <td>{{$record->blood_group}}</td>
                                            <td>{{$record->height}}</td>
                                            <td>{{$record->weight}}</td>
                                            <td>{{date('d-m-Y H:i', strtotime($record->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
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
