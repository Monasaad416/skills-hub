<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="icon" href="{{url('web/assets/img/icon.png')}}" type="image/x-icon"/>
  <title>SkillHub</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset("admin/css/fontawesome.all.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("admin/css/adminlte.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

@yield('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/dashboard')}}" class="brand-link">
      <img src="{{asset('web/assets/img/icon.png')}}" width="40" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SkillHub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('web/assets/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/dashboard/edit-profile',auth()->user()->id)}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active" style="background-color: #dc6c1b">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Skills Hub
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


          <li class="nav-item">
            <a href="{{url("/dashboard/categories")}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url("dashboard/skills")}}" class="nav-link">
              <i class="fas fa-lightbulb mx-2"></i>
              <p>
                Skills
              </p>
            </a>
          </li>


        <li class="nav-item">
            <a href="{{url("dashboard/exams")}}" class="nav-link">
              <i class="fas fa-copy mx-2"></i>
              <p>
                Exams
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url("dashboard/students")}}" class="nav-link">
              <i class="fas fa-user-graduate mx-2"></i>
              <p>
                Students
              </p>
            </a>
          </li>
          @if(Auth::user()->role->name == 'superadmin')
           <li class="nav-item">
            <a href="{{url("dashboard/admins")}}" class="nav-link">
              <i class="fas fa-users-cog mx-2"></i>
              <p>
                Admins
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{url("dashboard/messages")}}" class="nav-link">
               <i class="fas fa-envelope mx-2"></i>
              <p>
                Messages
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>
                profile
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @auth
                    <li class="nav-item">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    <li class="nav-item">
                        <a href="{{url("/dashboard/edit-profile/".auth()->user()->id) }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profile Info</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url("/dashboard/edit-password/".auth()->user()->id) }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Change Password</p>
                        </a>
                    </li>




                    <style>
                        .modal-backdrop{
                            z-index:10 !important;
                        }
                        .modal-content{
                            z-index: 99999 !important;
                        }
                    </style>

                    <!-- Change Admin Password modal start -->
                   <form action="{{url('dashboard/change-password',auth()->user()->id)}}" method="POST">
                        @csrf

                        <div class="modal" id="change-password-{{auth()->user()->id}}">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">

                                    <input type="password" name="new_password" class="form-control" placeholder="new-password">
                                    <input type="hidden" name="id" value={{auth()->user()->id}}>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Save Password</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                @endauth
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

@yield('main')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io" style="color: #dc6c1b">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("admin/js/jquery.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("admin/js/bootstrap.bundle.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("admin/js/adminlte.js")}}"></script>

@yield('script')
</body>
</html>
