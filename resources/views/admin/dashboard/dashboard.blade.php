@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3" style="display: flex; justify-content:space-evenly;">
                   <span style="display: flex; align-items:center;gap:3px;">
                    <h6 class="m-0 font-weight-bold" style="color:#4e73df;">Pending</h6>
                    <p style="height: 15px; width:15px; background:#4e73df; margin:0;"></p>
                   </span>
                   <span style="display: flex; align-items:center;gap:3px;">
                    <h6 class="m-0 font-weight-bold" style="color:#1cc88a;">Approve</h6>
                    <p style="height: 15px; width:15px; background:#1cc88a; margin:0;"></p>
                   </span>
                   <span style="display: flex; align-items:center;gap:3px;">
                    <h6 class="m-0 font-weight-bold" style="color:#8B4513;">Decline</h6>
                    <p style="height: 15px; width:15px; background:#8B4513; margin:0;"></p>
                   </span>
                   <span style="display: flex; align-items:center;gap:3px;">
                    <h6 class="m-0 font-weight-bold" style="color:red;">Expired</h6>
                    <p style="height: 15px; width:15px; background:red; margin:0;"></p>
                   </span>
                   <span style="display: flex; align-items:center;gap:3px;">
                    <h6 class="m-0 font-weight-bold" style="color:#25809c;">Done</h6>
                    <p style="height: 15px; width:15px; background:#25809c; margin:0;"></p>
                   </span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="row">
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Patients</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $patients_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wheelchair fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Doctors</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $doctors_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-doctor fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Account Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Appointments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointments_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-folder-open fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Self Appointed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointments_self_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Guardian Appointed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $appointments_guard_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user  fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dashboard/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($keys),
            datasets: [{
            data: @json($values),
            backgroundColor: ['#4e73df', '#1cc88a', '#8B4513','#ff0000' ,'#25809c'],
            hoverBackgroundColor: ['#2e59d9', '#17a673','#A0522D' ,'#DC143C', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            plugins: {
            datalabels: {
                display: true,
                align: 'bottom',
                backgroundColor: '#ccc',
                borderRadius: 3,
                font: {
                size: 18,
                },
            },
            },
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });
    </script>
@endsection
