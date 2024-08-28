<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicons -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('images/logo/logo.png') }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('dashboard/css/sb-admin-2.css') }}">
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>

    <!--carousel -->
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar  style="background:#347b33;"-->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="background:#1977cc;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guest.index') }}">
                <div class="sidebar-brand-icon">
                    <img style="width: 80px; height:100px; padding:5px 0px;" src="{{ asset('images/logo/logo.png') }}" alt="">
                  </div>
                <div class="sidebar-brand-text mx-3">BPH KIBAWE OPD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::is('doctor.dashboard*')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                List
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ Route::is('doctor.appointment*')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.appointment.index') }}">
                    <i class="fas fa-fw fa-list"></i>
                   <span>Appointment
                    @if ($notification)
                    <i style="border-radius:8px; background: rgb(18, 186, 18); color:white; padding:1px 4px; text-align:center;">
                    {{ $notification }}
                    </i>
                    @endif
                </span>
                </a>
            </li>

            <li class="nav-item {{ Route::is('doctor.history*')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.history.index') }}">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>History</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('doctor.account*')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.account.index') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Account</span>
                </a>
            </li>
            {{-- <li class="nav-item {{ Route::is('patient.history*')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('patient.history.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>History</span>
                </a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                      <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->email }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('dashboard/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->



    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->


    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->


    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->



    <!-- Page level custom scripts -->

    {{-- <script src="{{ asset('dashboard/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('dashboard/js/demo/chart-pie-demo.js') }}"></script> --}}


    <script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->


    <script src="{{ asset('dashboard/js/demo/datatables-demo.js') }}"></script>
    <script>
       $(document).ready(function() {
        $('#appointmentTable').DataTable();

        });
    </script>
</body>

</html>
