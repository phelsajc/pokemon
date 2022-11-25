<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pokemon | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend2/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend2/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('pdfjs-dist/web/viewer.css') }}">
{{--   <link rel="resource" type="application/l10n" href="{{ asset('locale/locale.properties') }}">

  <script src="{{ asset('pdfjs-dist/build/pdf.js') }}"></script>
  <script src="{{ asset('pdfjs-dist/web/viewer.js') }}"></script> --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center" >
      <img class="animation__shake" src="{{ asset('backend2/International_Pokémon_logo.png') }}" alt="AdminLTELogo" height="100" width="100">
    </div>

    <!-- Navbar -->
    <nav id="topbar" class="main-header navbar navbar-expand navbar-white navbar-light" style="display: none" v-show="$route.path === '/' || $route.path ==='/register' || $route.path ==='/forget' ? false : true ">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <router-link to="/all_employee" class="nav-link">Home</router-link>
        </li>
      </ul>
        
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>

     
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4" >
      <!-- Brand Logo -->
      <div v-show="$route.path === '/' || $route.path ==='/register' || $route.path ==='/forget' ? false : true " style="display: none">
        <router-link to="/all_employee" class="brand-link">
          <img src="{{ asset('backend2/International_Pokémon_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">&nbsp;</span>
        </router-link>
  
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            {{--   <img src="{{ asset('backend2/International_Pokémon_logo.png') }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
              <user-info></user-info>
              @{{ bladeValue }}
              {{-- <p id="user_name"></p> --}}

            </div>
          </div>
  
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             
               <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Menu
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <router-link to="/all_pokemon" class="collapse-item">List</router-link>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <router-link to="/userslist" class="collapse-item">Users</router-link>
                    </a>
                  </li>
                </ul>
              </li>
           
              <li class="nav-item">
                <router-link to="/logout" class="nav-link">
                  <p>
                    Logout
                  </p>
                </router-link>
              </li>
             
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <router-view></router-view>
    </div>

    <footer class="main-footer" v-show="$route.path === '/' || $route.path ==='/register' || $route.path ==='/forget' ? false : true " style="display: none">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-rc
      </div>
      <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <example></example>
    </aside>
    <!-- /.control-sidebar -->
  </div>

  {{-- <div id="login_div" class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div> --}}
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>
 /*  $.widget.bridge('uibutton', $.ui.button) */
</script>



<!-- jQuery -->
<script src="{{ asset('backend2/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend2/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('backend2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend2/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend2/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend2/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend2/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
{{-- <script src="{{ asset('backend2/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
{{-- <script src="{{ asset('backend2/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend2/daterangepicker/daterangepicker.js') }}"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{ asset('backend2/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
<!-- Summernote -->
<script src="{{ asset('backend2/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend2/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('backend2/dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('backend2/dist/js/pages/dashboard.js') }}"></script> --}}
<script type="text/javascript">
  $( document ).ready(function() {

    var $sidebar = $('.control-sidebar')
 

    let token = localStorage.getItem('token');
    if(token) {
        $("#sidebar").css("display","");
        $("#topbar").css("display","");
        $("#footer_div").css("display","");
        //  $("#user_name").text(localStorage.getItem('user_type'))
        if(localStorage.getItem('user_type')!="Administrator")
        {
          $("#usermenu").addClass("d-none")
        }else{
          $("#usermenu").removeClass("d-none")
        }
    }

    $("#btnsave").click(function(){
      $.ajax({
                        url:"{{ url('update-trainer') }}",
                        type: "post",
                        data: {
                          fname:$("#fname").val(),
                          lname:$("#lname").val(),
                          bday:$("#bday").val(),
                          id:localStorage.getItem('user_id'),
                        },
                        dataType: 'JSON',                                                
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                          
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error! Contact IT Department.');
                        }
                    }); 
    });

  });

  
(function ($) {
  'use strict'

  

  /* $container.append('<h6>Header Options</h6>') */
  /* var $header_fname = $('<input />', {
    type: 'text',
    checked: $('body').hasClass('layout-navbar-fixed'),
    class: 'mr-1 form-control',
    name: 'fname',
    id: 'fname',
    value: localStorage.getItem('fname'),
    placeholder: 'Enter First Name'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed')
    } else {
      $('body').removeClass('layout-navbar-fixed')
    }
  })
  var $header_fixed_container = $('<div />', { class: 'mb-1' }).append($header_fname)
  $container.append($header_fname)


  $container.append(
    '<h5></h5><hr class="mb-2"/>'
  )
  
  var $header_lname = $('<input />', {
    type: 'text',
    checked: $('body').hasClass('layout-navbar-fixed'),
    class: 'mr-1 form-control',
    name: 'lname',
    id: 'lname',
    placeholder: 'Enter Last Name',
    value: localStorage.getItem('lname'),
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed')
    } else {
      $('body').removeClass('layout-navbar-fixed')
    }
  })
  var $header_fixed_container = $('<div />', { class: 'mb-1' }).append($header_lname)
  $container.append($header_lname)


  $container.append(
    '<h5></h5><hr class="mb-2"/>'
  )
  
  var $header_lname = $('<input />', {
    type: 'text',
    checked: $('body').hasClass('layout-navbar-fixed'),
    class: 'mr-1 form-control',
    name: 'bday',
    id: 'bday',
    placeholder: 'Birthdate',
    value: localStorage.getItem('bday'),
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed')
    } else {
      $('body').removeClass('layout-navbar-fixed')
    }
  })
  var $header_fixed_container = $('<div />', { class: 'mb-1' }).append($header_lname)
  $container.append($header_lname)

 

  $container.append(
    '<h5></h5><hr class="mb-2"/>'
  )
  
  var $header_lname = $('<input />', {
    type: 'button',
    class: 'btn btn-success',
    value:'Update',
    name: 'btnsave',
    id: 'btnsave',
    placeholder: 'Birthdate',
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed')
    } else {
      $('body').removeClass('layout-navbar-fixed')
    }
  })
  var $header_fixed_container = $('<div />', { class: 'mb-1' }).append($header_lname)
  $container.append($header_lname) */

})(jQuery)
</script>
</body>
</html>
