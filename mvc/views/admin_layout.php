<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/public/admin/assets/img/favicon.ico">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet"
        href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/fontawesome/css/fontawesome.min.css">

    <!-- Calendar CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/calendar.css">

    <!-- Datatable-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/dataTables.bootstrap4.min.css">

    <!-- Select 2-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/select2.min.css">

    <!-- Datetime Picker-->
    <link rel="stylesheet"
        href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/datetimepicker/css/tempusdominus-bootstrap-4.min.css">

    <!--custom styles-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/style.css">

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header start -->
        <div class="header-menu">
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="<?php echo BASE_URL; ?>/public/admin/assets/img/Logo_Hospital.png" width="35" height="35"
                        alt="">
                    <span>PreAdmin</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="menubar">
                <a id="toggle_btn" href="javascript:void(0);"><i class="fas fa-bars"></i></a>
            </div>
            <!-- /Mobile Menu Toggle -->

            <!-- Search-->
            <div class="searchbar">
                <form class="form-inline my-1 w-25 float-left">
                    <input class="form-control mr-sm-2 search-input search_icon" type="search" placeholder="Search...">
                </form>
            </div>
            <!--/ Search-->

            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Right Menu -->
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="far fa-paper-plane"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a>
                </li>

                <!-- /Notifications -->
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="far fa-bell"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="John Doe"
                                                    src="<?php echo BASE_URL; ?>/public/admin/assets/img/user.jpg"
                                                    class="img-fluid">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">L</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">G</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                    added new task <span class="noti-title">Private chat module</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span>Jones Ferdinand</span>&nbsp;
                        <span class="user-img">
                            <img class="rounded-circle" src="<?php echo BASE_URL; ?>/public/admin/assets/img/user.jpg"
                                width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
            <!--/ Header Right Menu -->

            <!-- User Menu -->
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="#">Edit Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
            <!--/ User Menu -->
        </div>
        <!-- /Header -->

        <!--sidebar-->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="index.html"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="doctors.html"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li>
                            <a href="patients.html"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li>
                            <a href="settings.html"><i class="fa fa-cog"></i> <span>Settings</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-columns"></i> <span>Pages</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="login.html"> Login </a></li>
                                <li><a href="register.html"> Register </a></li>
                                <li><a href="forgot-password.html"> Forgot Password </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/sidebar-->

        <!-- content -->
        <div class="page-wrapper">
            <?php
            require_once "./mvc/views/pages/" . $Page . ".php";
            ?>
        </div>

        <!--scripts-->
        <!-- jQuery -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap Core JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/bootstrap.bundle.min.js"></script>

        <!-- Slimscroll JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/jquery.slimscroll.js"></script>

        <!-- Select2 JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/select2.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/moment.min.js"></script>

        <!-- Datetime picker JS -->
        <script
            src="<?php echo BASE_URL; ?>/public/admin/assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js">
        </script>

        <!-- Calender JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/calendar.min.js"></script>

        <!-- Apex chart JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/apex.js"></script>

        <!-- Custom JS -->
        <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/app.js"></script>

        <script>
        /*Donut Pie chart*/
        var options = {
            series: [44, 55],
            chart: {
                width: 280,
                type: 'donut',

            },


            colors: ['#1DBFC1', '#8EE2E3'],
            dataLabels: {
                enabled: false
            },

            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: false
                    }
                }
            }],
            legend: {
                position: 'right',
                offsetY: 0,
                height: 230,
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


        function appendData() {
            var arr = chart.w.globals.series.slice()
            arr.push(Math.floor(Math.random() * (100 - 1 + 1)) + 1)
            return arr;
        }

        function removeData() {
            var arr = chart.w.globals.series.slice()
            arr.pop()
            return arr;
        }

        function randomize() {
            return chart.w.globals.series.map(function() {
                return Math.floor(Math.random() * (100 - 1 + 1)) + 1
            })
        }

        function reset() {
            return options.series
        }
        </script>

        <script>
        /*Stastistics chart*/
        var options = {
            series: [{
                data: [
                    [1327359600000, 30.95],
                    [1327446000000, 31.34],
                    [1327532400000, 31.18],
                    [1327618800000, 31.05],
                    [1327878000000, 31.00],
                    [1327964400000, 30.95],
                    [1328050800000, 31.24],
                    [1328137200000, 31.29],
                    [1328223600000, 31.85],
                    [1328482800000, 31.86],
                    [1328569200000, 32.28],
                    [1328655600000, 32.10],
                    [1328742000000, 32.65],
                    [1328828400000, 32.21],
                    [1329087600000, 32.35],
                    [1329174000000, 32.44],
                    [1329260400000, 32.46],
                    [1329346800000, 32.86],
                    [1329433200000, 32.75],
                    [1329778800000, 32.54],
                    [1329865200000, 32.33],
                    [1329951600000, 32.97],
                    [1330038000000, 33.41],
                    [1330297200000, 33.27],
                    [1330383600000, 33.27],
                    [1330470000000, 32.89],
                    [1330556400000, 33.10],
                    [1330642800000, 33.73],
                    [1330902000000, 33.22],
                    [1330988400000, 31.99],
                    [1331074800000, 32.41],
                    [1331161200000, 33.05],
                    [1331247600000, 33.64],
                    [1331506800000, 33.56],
                    [1331593200000, 34.22],
                    [1331679600000, 33.77],
                    [1331766000000, 34.17],
                    [1331852400000, 33.82],
                    [1332111600000, 34.51],
                    [1332198000000, 33.16],
                    [1332284400000, 33.56],
                    [1332370800000, 33.71]

                ]
            }],
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 350,
                zoom: {
                    autoScaleYaxis: true
                }
            },
            colors: ['#1DBFC1', '#8EE2E3'],
            annotations: {
                yaxis: [{
                    y: 30,
                    borderColor: '#999',
                    label: {
                        show: true,
                        text: 'Support',
                        style: {
                            color: "#fff",
                            background: '#00E396'
                        }
                    }
                }],
                xaxis: [{
                    x: new Date('14 Nov 2012').getTime(),
                    borderColor: '#999',
                    yAxisIndex: 0,
                    label: {
                        show: true,
                        text: 'Rally',
                        style: {
                            color: "#fff",
                            background: '#775DD0'
                        }
                    }
                }]
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                style: 'hollow',
            },
            xaxis: {
                type: 'datetime',
                min: new Date('01 Mar 2012').getTime(),
                tickAmount: 6,
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100]
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
        chart.render();


        var resetCssClasses = function(activeEl) {
            var els = document.querySelectorAll('button')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }
        </script>

        <script>
        /*bar chart*/
        var options = {
            series: [{
                name: 'Inflation',
                data: [2.2, 1.3, 2.4, 0.8]
            }],
            chart: {
                height: 400,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 0,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },

            dataLabels: {
                enabled: false,
                formatter: function(val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',

                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#fff',
                    colorTo: '#fff',
                    stops: [0, 100],
                    opacityFrom: .7,
                    opacityTo: .3,
                    shade: 'light',
                    type: "vertical",
                    shadeIntensity: 1,

                }
            },

            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            dataLabels: {
                enabled: true,
            },

            xaxis: {

                categories: [],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },

                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },
            title: {
                text: '',
                floating: false,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#bar_chart"), options);
        chart.render();
        </script>

        <script>
        var config =
            `function selectDate(date) {
          $('.calendar-wrapper').updateCalendarOptions({
            date: date
          });
        }

        var defaultConfig = {
          weekDayLength: 1,
          date: new Date(),
          onClickDate: selectDate,
          showYearDropdown: true,
          startOnMonday: true,
        };

        $('.calendar-wrapper').calendar(defaultConfig);`;
        eval(config);
        </script>
</body>

</html>