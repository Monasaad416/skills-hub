@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">Exams</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">exams</li>
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
                <h3 class="card-title">All Exams</h3>

                <div class="card-tools">
                  <a href="{{url("/dashboard/exams/create")}}" class="btn add" >
                  Add Exam
                 </a>
                </div>

              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name (en)</th>
                      <th>Name (Ar)</th>
                      <th>Image</th>
                      <th>Skill</th>
                      <th>Questions no.</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($exams as $exam)
                              <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$exam->name('en')}}</td>
                      <td>{{$exam->name('ar')}}</td>
                      <td>
                          <img src="{{asset("uploads/$exam->img")}}" height="50px" alt="">
                      </td>
                      <td>{{$exam->skill->name('en')}}</td>
                      <td>{{$exam->questions_no}}</td>
                      <td>
                          @if($exam->active)
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Not Active</span>
                          @endif
                      </td>
                      <td>
                        <a href="{{url("/dashboard/exams/show/$exam->id")}}" class="btn btn-primary" ><i class="fas fa-eye"></i></a>
                        <a href="{{url("/dashboard/exams/show-questions/$exam->id")}}" class="btn btn-warning text-white" ><i class="fas fa-question"></i></a>
                        <a href="{{url("/dashboard/exams/edit/$exam->id")}}" class="btn btn-info" > <i class="fas fa-edit"></i></a>
                        <a href="{{url("/dashboard/exams/toggle/$exam->id")}}" class="btn btn-small btn-{{$exam->active == 1 ? 'success' : 'secondary'}} mx-1"><i class="fas fa-toggle-{{$exam->active == 1 ? 'on' : 'off'}}"></i></a>
                        <a href="{{url("/dashboard/exams/delete/$exam->id")}}" onclick="confirm('Are You Sure You Want To delete Exam?') || event.stopImmediatePropagation()"class="btn btn-small btn-danger mx-1"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>

                    @endforeach

                  </tbody>
                </table>
                <div class="d-flex justify-content-center my-5"> {{$exams->links()}}</div>

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
<!-- modal to add category -->

<div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

                @include('admin.inc.errors')

              <form method="POST" action="{{url('dashboard/categories/store')}}" id="add-form">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name (Ar)</label>
                            <input type="text" name="name_en" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Name (En)</label>
                        <input type="text"  name="name_ar" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" form="add-form"class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<!--/ modal to add category -->

<!--modal to edit category -->
<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

                @include('admin.inc.errors')

              <form method="POST" action="{{url('dashboard/categories/update')}}" id="edit-form">
                @csrf
                <input type="hidden" name="id" id="edit-form-id"/>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name (Ar)</label>
                            <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Name (En)</label>
                        <input type="text"  name="name_ar" class="form-control" id="edit-form-name-ar">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" form="edit-form"class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<!--/modal to edit category -->
@endsection



