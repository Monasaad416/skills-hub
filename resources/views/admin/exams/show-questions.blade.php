@extends('admin.layout')

@section('main')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 my-4">
            <h1 class="m-0 text-dark text-capitalize">exam : {{$exam->name('en')}} questions</h1>
            <h2 class="m-0 text-dark text-capitalize">skill :  {{$exam->skill->name('en')}} skill</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url("dashboard/exams")}}">Exams</a></li>
              <li class="breadcrumb-item"><a href="{{url("dashboard/exams/show/$exam->id")}}">{{$exam->name('en')}} </a></li>
              <li class="breadcrumb-item active">Questions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-md-1 pb-3">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Exam Questions</h3>
                </div>
                <!-- /.card-header -->

                 <!-- .card-body -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Options</th>
                        <th>Right Ans.</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam->questions as $ques)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ques->title}}</td>
                                <td>
                                    {{$ques->option_1}}|<br>
                                    {{$ques->option_2}}|<br>
                                    {{$ques->option_3}}|<br>
                                    {{$ques->option_4}}
                                </td>
                                <td>{{$ques->right_ans}}</td>
                                <td>
                                    @if($exam->active)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <a href="{{url("/dashboard/exams/show/$exam->id")}}" class="btn btn-primary" ><i class="fas fa-eye"></i></a>
                                    <a href="{{url("/dashboard/exams/show/$exam->id/questions")}}" class="btn btn-success" ><i class="fas fa-question"></i></a>
                                    <a href="{{url("/dashboard/exams/edit/$exam->id")}}" class="btn btn-info" > <i class="fas fa-edit"></i></a>
                                    <a href="{{url("/dashboard/exams/toggle/$exam->id")}}" class="btn btn-small btn-secondary mx-1"><i class="fas fa-toggle-on"></i></a>
                                    <a href="{{url("/dashboard/exams/delete/$exam->id")}}"onclick="confirm('Are You Sure You Want To delete questions?') || event.stopImmediatePropagation()" class="btn btn-small btn-danger mx-1"><i class="fas fa-trash-alt"></i></a>
                                </td> --}}

                                <td>
                                    <a href="{{url("/dashboard/exams/edit-question/{$exam->id}/{$ques->id}")}}" class="btn btn-info" > <i class="fas fa-edit"></i></a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                    </table>
                </div>


              </div>
                <!-- /.card-body -->

                 <a href="{{url("/dashboard/exams")}}" class="btn btn-sm btn-primary text-capitalize" >back to all exams</a>
                 <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary text-capitalize">back</a>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection
