@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
{{--                        <h1>Admin List (Total: {{ $getRecords->total() }})</h1>--}}
                        <h1>Notice Board</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="{{ url('admin/communicate/notice_board/add') }}" class="btn btn-primary">Add New Notice Board</a>
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
                                <h3 class="card-title">Search Notice Board</h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('title') }}" name="title"
                                                   placeholder="Enter title">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="notice_date_from">Notice Date From</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('notice_date_from') }}" name="notice_date_from">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="notice_date_to">Notice Date To</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('notice_date_to') }}" name="notice_date_to">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="publish_date_from">Publish Notice Date From</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('publish_date_from') }}" name="publish_date_from">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="publish_date_to">Publish Notice Date To</label>
                                            <input type="date" class="form-control" value="{{ \Illuminate\Support\Facades\Request::get('publish_date_to') }}" name="publish_date_to">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="title">Message To</label>
                                            <select class="form-control" name="message_to">
                                                <option>Select</option>
                                                <option value="3" {{ (\Illuminate\Support\Facades\Request::get('message_to') == 3) ? 'selected' : '' }}>Student</option>
                                                <option value="4" {{ (\Illuminate\Support\Facades\Request::get('message_to') == 4) ? 'selected' : '' }}>Parent</option>
                                                <option value="2" {{ (\Illuminate\Support\Facades\Request::get('message_to') == 2) ? 'selected' : '' }}>Teacher</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 10px">Search</button>
                                            <a href="{{ url('admin/communicate/notice_board') }}" class="btn btn-success" style="margin-top: 10px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card -->
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Notice Board List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Notice Date</th>
                                        <th>Publish Date</th>
                                        <th>Message To</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($getRecords as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td>{{$record->title}}</td>
                                            <td>{{date('M d, Y', strtotime($record->notice_date))}}</td>
                                            <td>{{date('M d, Y', strtotime($record->publish_date))}}</td>
                                            <td>
                                                @foreach($record->getMessage as $message)
                                                    @if($message->message_to == 2)
                                                        <div>Teacher</div>
                                                    @elseif($message->message_to == 3)
                                                        <div>Student</div>
                                                    @elseif($message->message_to == 4)
                                                        <div>Parent</div>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$record->created_by_name}}</td>
                                            <td>{{date('M d, Y H:i A', strtotime($record->created_at))}}</td>
                                            <td>
                                                <a href="{{ url('admin/communicate/notice_board/edit/' . $record->id) }}"
                                                   class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/communicate/notice_board/delete/' . $record->id) }}"
                                                   class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">Records Not Found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div style="padding: 10px 10px 0 10px; float: right;">
                                    {!! $getRecords->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
