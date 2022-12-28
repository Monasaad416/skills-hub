@extends('admin.layout')

@section('main')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">{{$message->name}}</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url("dashboard/messages")}}">Messages</a></li>
              <li class="breadcrumb-item active">{{$message->name}}</li>
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
                    <h3 class="card-title">Message Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                            <th>Name</th>
                            <td>
                                {{$message->name}}
                            </td>
                            </tr>
                            <tr>
                            <th>Email</th>
                            <td>
                                {{$message->email}}
                            </td>
                            </tr>

                            <tr>
                            <th>Subject</th>
                            <td>
                                {{$message->subject}}
                            </td>
                            </tr>
                            <tr>
                            <th>Body</th>
                            <td>
                                {{$message->body}}
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->


                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


              <div class="row">
            <div class="col-md-10 offset-md-1 pb-3">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Message Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
               @include("admin.inc.errors")

                <form method="POST" action="{{url("dashboard/messages/response/$message->id")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label>Title</label>
                                <input type="text"  name="title" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Body</label>
                                    <textarea class="form-control" name="body" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                    </div>
                </form>
                </div>
                <!-- /.card-body -->


                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection
