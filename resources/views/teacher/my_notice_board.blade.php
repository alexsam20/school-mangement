@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>My Notice Board</h1>
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
                                <h3 class="card-title">Search Notice Board</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('title') }}" name="title"
                                                   placeholder="Enter title">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="notice_date_from">Notice Date From</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('notice_date_from') }}" name="notice_date_from">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="notice_date_to">Notice Date To</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('notice_date_to') }}" name="notice_date_to">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                            <a href="{{ url('teacher/my_notice_board') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    @foreach($getRecords as $record)
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="mailbox-read-info">
                                        <h5>{{ $record->title }}</h5>
                                        <h6><span class="mailbox-read-time float-right"
                                                  style="font-weight: bold; font-size: 15px;">{{ date('d-m-Y', strtotime($record->notice_date)) }}</span>
                                        </h6>
                                    </div>
                                    <div class="mailbox-read-message">
                                        {!! $record->message !!}
                                    </div>
                                    <!-- /.mailbox-read-message -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    @endforeach

                    <div class="col-md-12">
                        @if(!empty($getRecords))
                            <div style="padding: 10px 10px 0 10px; float: right;">
                                {!! $getRecords->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        @endif
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
