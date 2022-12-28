@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h2 class="m-0 text-dark">Edit Question #{{$ques->id}}</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/$exam->id")}}">Exam</a></li>
                <li class="breadcrumb-item active"><a href="{{url("dashboard/exams/show-questions/$exam->id")}}">Exam Questions</a></li>
                <li class="breadcrumb-item active">Edit question #{{$ques->id}}</li>
            </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-3">

                @include("admin.inc.errors")

                <form method="POST" action="{{url("dashboard/exams/update-question/{$exam->id}/{$ques->id}")}}" >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Title</label>
                                <input type="text"  name="title" class="form-control" value="{{$ques->title}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Right Ans.</label>
                                    <input type="number" name="right_ans" class="form-control" value="{{$ques->right_ans}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Option_1</label>
                                <input type="text"  name="option_1" class="form-control" value="{{$ques->option_1}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Option_2</label>
                                <input type="text"  name="option_2" class="form-control"  value="{{$ques->option_2}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Option_3</label>
                                <input type="text"  name="option_3" class="form-control"  value="{{$ques->option_3}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label>Option_4</label>
                                <input type="text"  name="option_4" class="form-control"  value="{{$ques->option_4}}"">
                                </div>
                            </div>
                        </div>
                    <div >
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
                </div>
                </div>

            </div>
    </div>
</div>
@endsection
