@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h2 class="m-0 text-dark">Create new Exam</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url("dashboard/exams")}}">Exams</a></li>
                <li class="breadcrumb-item active">Edit Exam</li>
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

                <form method="POST" action="{{url("dashboard/exams/update/$exam->id")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Name (En)</label>
                                <input type="text"  name="name_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (Ar)</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Description (En)</label>
                                <input type="text"  name="desc_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Description (Ar)</label>
                                    <input type="text" name="desc_ar" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Skill</label>
                                <select class="custom-select form-control" name="skill_id" >
                                    @foreach ( $skills as $skill )
                                        <option value="{{$skill->id}}" @if ($exam->skill_id == $skill->id) selected @endif>{{$skill->name('en')}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input">
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Difficulty</label>
                                    <input type="number" name="difficulty" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Duration(mins)</label>
                                    <input type="number" name="duration_mins" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div >
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
                </div>
                </div>

            </div>
    </div>
</div>
@endsection
