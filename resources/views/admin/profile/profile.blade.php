@extends('admin.layout')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">Update Profile</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Update Profile</li>
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
            @include("admin.inc.errors")

            <form method="POST" action='{{ url("/dashboard/update-profile/$user->id") }}' id="update-profile-form">
                @csrf


                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value={{$user->name}}>
                    </div>
                    <input type="hidden" name="id"  value={{$user->id}}/>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value={{$user->email}}>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" form="update-profile-form">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection





