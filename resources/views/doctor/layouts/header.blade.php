<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:20 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <title>Rahul - Dashboard</title>

    <!-- Favicon -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/img/favicon.png"
    />

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/font-awesome.min.css')}}">

    <!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/feathericon.min.css')}}">


	<link rel="stylesheet" href="{{url('admin_assets/plugins/morris/morris.css')}}">

    <!-- Main CSS -->
	<link rel="stylesheet" href="{{url('admin_assets/css/style.css')}}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  


    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
    <style>
    .header .header-left .logo img {
    max-height: 70px !important;
    width:200px !important;
}
.header .header-left .logo-small img {
    max-height: 50px !important;
    width:100px !important;
}
  </style>
  <body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
      <!-- Header -->
      <div class="header">
        <!-- Logo -->
       <div class="header-left">
          
          </a>
        </div>
        <!-- /Logo -->

        <a href="javascript:void(0);" id="toggle_btn">
          <i class="fe fe-text-align-left"></i>
        </a>

      

        <!-- Mobile Menu Toggle -->
        <a class="mobile_btn" id="mobile_btn">
          <i class="fa fa-bars"></i>
        </a>
        <!-- /Mobile Menu Toggle -->

        <!-- Header Right Menu -->
        <ul class="nav user-menu">
        

          <!-- User Menu -->
          <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <span class="user-img"
                ><img
                  class="rounded-circle"
                  src="admin_assets/img/profiles/avatar-01.jpg"
                  width="31"
                  alt="Ryan Taylor"
              /></span>
            </a>
            <div class="dropdown-menu">
              <div class="user-header">
                <div class="avatar avatar-sm">
                  
                </div>
                <div class="user-text">
                  <h6>User</h6>
                  <p class="text-muted mb-0">User</p>
                </div>
              </div>
              <a class="dropdown-item" id="logoutButton">Logout</a>
            </div>
          </li>
          <!-- /User Menu -->
        </ul>
        <!-- /Header Right Menu -->
      </div>
      <!-- /Header -->

      <!-- Sidebar -->
      <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
            <ul>
              <li class="menu-title">
                <span>Main</span>
              </li>
              <li class="@yield('list-appo')"> 
                <a href="{{ url('list-appo') }}">
                  <i class="fe fe-home"></i>
                  <span>Apppoitment SChedule</span>
                </a>
              </li>
               <li class="@yield('create-appo')"> 
                <a href="{{ url('create-appo') }}">
                  <i class="fe fe-home"></i>
                  <span>Create SChedule</span>
                </a>
              </li>
              <li class="@yield('doctor-historys')"> 
                <a href="{{ url('doctor-historys') }}">
                  <i class="fe fe-home"></i>
                  <span>Appointment History</span>
                </a>
              </li>
               <li class="@yield('doctor-users')"> 
                <a href="{{ url('users-lists') }}">
                  <i class="fe fe-home"></i>
                  <span>Users lists</span>
                </a>
              </li>
           
            
              
            
             
             
             
            
            </ul>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->
<script>
	 $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
  $(document).ready(function () {
    $('#logoutButton').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: '{{ route("doctor.logout") }}',
            success: function (response) {
                if (response.status === 200) {
                    alert("Logout Successfully");
                    window.location.href = "{{ url('doctorlogin') }}";
                } else {
                    alert("Logout Failed");
                }
            },
            error: function (error) {
                console.error('Ajax request failed:', error);
            }
        });
    });
});

</script>
	