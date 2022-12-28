@extends('admin.layout')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0 text-dark">Change Admin Password</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Change Admin Password</li>
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

            <form method="POST" action='{{ url("/dashboard/change-password/$user->id") }}' id="update-password-form">
                @csrf


                <div class="card-body">
                    <div class="form-group">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                    </div>
                    <input type="hidden" name="id"  value={{$user->id}}/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" form="update-password-form">Submit</button>
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





