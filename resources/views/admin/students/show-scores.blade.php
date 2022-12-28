
@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">Show {{$student->name}} Scores</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="database/">Home</a></li>
             <li class="breadcrumb-item"><a href="dashboard/students">Students</a></li>
            <li class="breadcrumb-item active">STudents</li>
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
        <div class="col-12">

            @include("admin.inc.messages")


            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Scores</h3>

              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID </th>
                      <th>Exam </th>
                      <th>Score</th>
                      <th>Time</th>
                      <th>At</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($exams as $exam)
                      <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$exam->name('en')}}</td>
                      <td>{{$exam->pivot->score}}</td>
                      <td>{{$exam->pivot->time_mins}}</td>
                      <td>{{$request->title}}</td>
                      <td>{{$exam->pivot->status}}</td>
                      <td>
                      @if($exam->pivot->status == 'closed')
                        <a href="{{url("dashboard/students/open-exam/$student->id/$exam->id")}}" class="badge badge-success"><i class="fa fa-lock-open" aria-hidden="true"></i></a>
                     @else
                          <a href="{{url("dashboard/students/close-exam/$student->id/$exam->id")}}" class="badge badge-danger"><i class="fa fa-lock" aria-hidden="true"></i></a>
                     @endif
                    </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>


              </div>
              <!-- /.card-body -->
            </div>
        </div>

    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
