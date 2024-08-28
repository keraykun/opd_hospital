@extends('admin.layout')
@section('content')
<div class="col-xl-12 col-lg-6">
            <div class="row">
           <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3" style="display: flex; justify-content:space-evenly;">
                       <span style="display: flex; align-items:center;gap:3px;">
                        <h6 class="m-0 font-weight-bold" style="color:#4e73df;">Pending</h6>
                        <span>{{ $pending_count }}</span>
                       </span>
                       <span style="display: flex; align-items:center;gap:3px;">
                        <h6 class="m-0 font-weight-bold" style="color:#1cc88a;">Approve : </h6>
                         <span>{{ $approve_count }}</span>
                       </span>
                       <span style="display: flex; align-items:center;gap:3px;">
                        <h6 class="m-0 font-weight-bold" style="color:#8B4513;">Decline</h6>
                        <span>{{ $decline_count }}</span>
                       </span>
                       <span style="display: flex; align-items:center;gap:3px;">
                        <h6 class="m-0 font-weight-bold" style="color:red;">Expired</h6>
                        <span>{{ $expired_count }}</span>
                       </span>
                       <span style="display: flex; align-items:center;gap:3px;">
                        <h6 class="m-0 font-weight-bold" style="color:#25809c;">Done</h6>
                        <span>{{ $done_count }}</span>
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
             <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Appointment Income</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
               </div>
           </div>
        </div>
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Services</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $services_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-heartbeat fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
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
                <div class="col-xl-3 col-lg-3 mb-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Rooms</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rooms_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-bed fa-2x"></i>
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
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(amount, currencyCode = 'PHP') {
    return amount.toLocaleString('en-PH', {
        style: 'currency',
        currency: currencyCode,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    }
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($bills[0]),
        datasets: [{
        label: "Earnings",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: @json($bills[1]),
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + number_format(tooltipItem.yLabel);
            }
        }
        }
    }
    });

    </script>
@endsection
