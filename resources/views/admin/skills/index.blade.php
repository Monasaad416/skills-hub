@extends('admin.layout')


@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">Skills</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Skills</li>
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
                <h3 class="card-title">All Skills</h3>

                <div class="card-tools">
                  <a type="button" class="btn add" data-toggle="modal" data-target="#add-modal">
                  Add Skill
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
                      <th>Category</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($skills as $skill)
                              <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$skill->name('en')}}</td>
                      <td>{{$skill->name('ar')}}</td>
                      <td>
                          <img src="{{asset("uploads/$skill->img")}}" height="50px" alt="">
                      </td>
                      <td>{{$skill->cat->name('en') }}</td>
                      <td>
                          @if($skill->active)
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Not Active</span>
                          @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-small btn-info mx-1 edit-btn" data-id="{{$skill->id}}" data-name-en="{{$skill->name('en')}}" data-name-ar="{{$skill->name('ar')}}" data-img="{{$skill->img}}" data-cat-id="{{$skill->cat_id}}" data-toggle="modal" data-target="#edit-modal">
                             <i class="fas fa-edit"></i>
                        </button>
                        <a href="{{url("/dashboard/skills/toggle/$skill->id")}}" class="btn btn-small btn-secondary mx-1"><i class="fas fa-toggle-on"></i></a>
                        <a href="{{url("/dashboard/skills/delete/$skill->id")}}" class="btn btn-small btn-danger mx-1"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>

                    @endforeach

                  </tbody>
                </table>
                <div class="d-flex justify-content-center my-5"> {{$skills->links()}}</div>

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
<!-- modal to add skill -->

<div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Skill</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

                @include('admin.inc.errors')

              <form method="POST" action="{{url('dashboard/skills/store')}}" id="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Name (En)</label>
                        <input type="text"  name="name_en" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name (Ar)</label>
                            <input type="text" name="name_ar" class="form-control" id="exampleInputEmail1">
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>Category</label>

                            <select class="custom-select form-control" name="cat_id">
                                @foreach ( $cats as $cat )
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label >Image input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img"n>
                                    <label class="custom-file-label" >Choose image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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

<!--/ modal to add skill -->

<!--modal to edit skill -->
<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Skill</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

                @include('admin.inc.errors')

              <form method="POST" action="{{url('dashboard/skills/update')}}" id="edit-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit-form-id"/>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label >Name (En)</label>
                        <input type="text"  name="name_en" class="form-control" id="edit-form-name-en">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name (Ar)</label>
                            <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Image input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img">
                                    <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Skill</label>

                            <select class="custom-select form-control" name="cat_id" id="edit-form-cat-id">
                                @foreach ( $cats as $cat )
                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
                                @endforeach
                            </select>
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


@section('script')
<script>
    $('.edit-btn').click(function(){
        let id = $(this).attr('data-id');
        let nameEn = $(this).attr('data-name-en');
        let nameAr = $(this).attr('data-name-ar');
        let img = $(this).attr('data-im');
        let catId = $(this).attr('data-cat-id');
        // console.log(id,nameAr,nameEn);
        $('#edit-form-id').val(id);
        $('#edit-form-name-en').val(nameEn);
        $('#edit-form-name-ar').val(nameAr);
        $('#edit-form-cat-id').val(catId);

})
</script>

@endsection
