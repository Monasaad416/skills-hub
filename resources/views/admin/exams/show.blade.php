@extends('admin.layout')

@section('main')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">{{$exam->name('en')}}</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url("dashboard/exams")}}">Exams</a></li>
              <li class="breadcrumb-item active">{{$exam->name('en')}}</li>
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
                    <h3 class="card-title">Exam Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <tbody>
                        <tr>
                        <th>Name (en)</th>
                        <td>
                            {{$exam->name('en')}}
                        </td>
                        </tr>
                        <tr>
                        <th>Name (ar)</th>
                        <td>
                            {{$exam->name('ar')}}
                        </td>
                        </tr>

                        <tr>
                        <th>Skill (en)</th>
                        <td>
                            {{$exam->skill->name('en')}}
                        </td>
                        </tr>
                        <tr>
                        <th>Skill (ar)</th>
                        <td>
                            {{$exam->skill->name('ar')}}
                        </td>
                        </tr>

                        <tr>
                        <th>Image</th>
                        <td>
                            <img src="{{asset("uploads/$exam->img")}}" height="50px" alt="">
                        </td>
                        </tr>
                        <tr>
                        <th>No. Of Questiond</th>
                        <td>
                            {{$exam->questions_no}}
                        </td>
                        </tr>

                        <tr>
                        <th>Duration(mins)</th>
                        <td>
                            {{$exam->duration_mins}}
                        </td>
                        </tr>

                        <tr>
                        <th>Active</th>
                        <td>
                            @if($exam->active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Not active</span>
                            @endif
                        </td>
                        </tr>


                        <tr>
                        <th>Description(en)</th>
                        <td>
                            {{$exam->desc('en')}}
                        </td>
                        </tr>
                        <tr>
                        <th>Description (ar)</th>
                        <td>
                            {{$exam->desc('ar')}}
                        </td>
                        </tr>

                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                 <div class="my-4 mx-2">
                    <a href="{{url("dashboard/exams/show-questions/$exam->id")}}" class="btn btn-sm btn-primary" >Show Exam Questions</a>
                    <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary">Back</a>
                 </div>

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
