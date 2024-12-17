@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Notice Board</h1>
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
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form method="post" action="">
                                {{ @csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input type="text" class="form-control" value="{{ $getRecord->title }}" name="title" required
                                               placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="notice_date">Notice Date</label>
                                        <input type="date" class="form-control" value="{{ $getRecord->notice_date }}" name="notice_date" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="publish_date">Publish Date</label>
                                        <input type="date" class="form-control" value="{{ $getRecord->publish_date }}" name="publish_date" required />
                                    </div>
                                    @php
                                        $message_to_student = $getRecord->getMessageToSingle($getRecord->id, 3);
                                        $message_to_parent = $getRecord->getMessageToSingle($getRecord->id, 4);
                                        $message_to_teacher = $getRecord->getMessageToSingle($getRecord->id, 2);
                                    @endphp
                                    <div class="form-group">
                                        <label style="display: block;" for="name">Message To</label>
                                        <label style="margin-right: 30px;">
                                            <input type="checkbox" {{ !empty($message_to_student) ? 'checked' : '' }} value="3" name="message_to[]"> Student
                                        </label>
                                        <label style="margin-right: 30px;">
                                            <input type="checkbox" {{ !empty($message_to_parent) ? 'checked' : '' }} value="4" name="message_to[]"> Parent
                                        </label>
                                        <label>
                                            <input type="checkbox" {{ !empty($message_to_teacher) ? 'checked' : '' }} value="2" name="message_to[]"> Teacher
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Message</label>
                                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">{{ $getRecord->message }}</textarea>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
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
    <script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote({
                height: 250,
                codemirror: {
                    theme: 'monokai'
                }
            });
        })
    </script>
@endsection
