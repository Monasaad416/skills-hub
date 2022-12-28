@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">students</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
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
                <h3 class="card-title">All Students</h3>


              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name </th>
                      <th>Email</th>
                      <th>verified</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $stud)
                      <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$stud->name}}</td>
                      <td>{{$stud->email}}</td>
                      <td>
                        @if($stud->email_verified_at)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-danger">Not Verified</span>
                        @endif
                      </td>
                      <td>
                          <a href="{{url("dashboard/students/show-student/$stud->id")}}" class="badge badge-primary">
                            <i class="fas fa-percentage"></i>
                          </a>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                <div class="d-flex justify-content-center my-5"> {{$students->links()}}</div>

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

