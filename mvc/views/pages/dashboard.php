<!-- content -->
<div class="page-wrapper">
    <div class="content">

        <!-- Dashboard-->
        <div class="row">
            <div class="col-lg-9">
                <h4 class="admin_title">Tổng quan</h4>
                <div class="row bg-white m-0 mb-4">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 pr-0">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1">
                                <img src="<?php echo BASE_URL ?>/public/admin/assets/img/my-icons/icon-1.5.png"
                                    alt="Icon" width="25">
                            </span>
                            <div class="dash-widget-info float-left pl-2">
                                <p>Số Nguời Dùng</p>
                                <h4><?php echo count($all_users) ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 pr-0">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><img
                                    src="<?php echo BASE_URL ?>/public/admin/assets/img/my-icons/icon-2.4.png"
                                    alt="Icon" width="25"></span>
                            <div class="dash-widget-info float-left pl-2">
                                <p>Số Bài Viết</p>
                                <h4><?php echo count($posts) ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 pr-0">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><img
                                    src="<?php echo BASE_URL ?>/public/admin/assets/img/my-icons/icon-3.9.png"
                                    alt="Icon" width="25"></span>
                            <div class="dash-widget-info float-left pl-2">
                                <p>số câu hỏi</p>
                                <h4><?php echo count($questions) ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 pr-0">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><img
                                    src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/icon-4.png" alt="Icon"
                                    width="25"></span>
                            <div class="dash-widget-info float-left pl-2">
                                <p>Báo cáo(*)</p>
                                <h4>25</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Patient statistics-->
                <h4 class="admin_title">THỐNG KÊ NGƯỜI DÙNG</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 ">
                                <div class="chart-title">
                                    <h4 class="title is-3 ">
                                        <span class="dollar">
                                            <i class="fas fa-dollar-sign text-white"></i>
                                        </span>&nbsp;
                                        22-29 May 2021
                                    </h4>
                                    <ul class="list-inline-item list-unstyled float-right year">
                                        <li class="list-inline-item">YEAR</li>
                                        <li class="list-inline-item">MONTH</li>
                                        <li class="list-inline-item active">WEEK</li>
                                    </ul>
                                </div>
                                <div id="chart-timeline"></div>
                            </div>
                            <div class="col-md-4 bg-green">
                                <div id="bar_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Patient statistics-->
            </div>
            <div class="col-lg-3">
                <!--Doctors Appointment-->
                <h4 class="admin_title">Doctor’s Appointment</h4>
                <div class="card">
                    <div class="card-body d-flex surgeon">
                        <div class="heart">
                            <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/vector-1.png" alt="Img">
                        </div>
                        <div class="ml-3">
                            <h5>Heart Surgeon</h5>
                            <span>10:30 - 12:30</span>
                            <h6>Dr. Caroline Hutomo</h6>
                        </div>
                    </div>
                </div>
                <!--Doctors Appointment-->
                <div class="card">
                    <div class="card-body d-flex surgeon">
                        <div class="pediatrician">
                            <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/vector-3.png" alt="Img">
                        </div>
                        <div class="ml-3">
                            <h5>Pediatrician</h5>
                            <span>09:30 - 10:30</span>
                            <h6>Dr. Anggia Melanie</h6>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body d-flex surgeon">
                        <div class="neurologist">
                            <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/vector-2.png" alt="Img">
                        </div>
                        <div class="ml-3">
                            <h5>Neurologist</h5>
                            <span>11:10 - 14:00</span>
                            <h6>Dr. Malik Abimanyu</h6>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body d-flex surgeon">
                        <div class="pediatrician">
                            <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/vector-3.png" alt="Img">
                        </div>
                        <div class="ml-3">
                            <h5>Pediatrician</h5>
                            <span>09:30 - 10:30</span>
                            <h6>Dr. Anggia Melanie</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Dashboard-->

        <!-- Income section-->
        <div class="row">
            <div class="col-lg-4 d-flex Chart">
                <!--Income-->
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="admin_title">INCOME</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12 text-right">
                                <div class="this_year">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle" data-toggle="dropdown">
                                            This year
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">2000</a>
                                            <a class="dropdown-item" href="#">2001</a>
                                            <a class="dropdown-item" href="#">2002</a>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="chart"></div>
                                <ul class="list-inline-item list-unstyled m-0">
                                    <li class="list-inline-item expense"><i
                                            class="fas fa-circle"></i>&nbsp;&nbsp;Expenses</li>
                                    <li class="list-inline-item income"><i class="fas fa-circle"></i>&nbsp;&nbsp;Income
                                    </li>
                                </ul>
                            </div>
                            <div class="income_expense">
                                <div class="income_det pt-5">
                                    <h1>65%</h1>
                                    <p>INCOME</p>
                                </div>
                                <div class="expense_det pt-4">
                                    <h1>29%</h1>
                                    <p>EXPENSES</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Income-->
            </div>
            <div class="col-lg-5 calendar_item d-flex">
                <!--Calender-->
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="admin_title">CALENDER</h4>
                    </div>
                    <div class="card-body">
                        <div class="calendar-wrapper"></div>
                    </div>
                </div>
                <!--/ calender-->
            </div>
            <div class="col-lg-3 d-flex">
                <!--Balence-->
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4 class="admin_title">BALANCE</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="dropdown months text-right">
                            <button type="button" class="btn p-0 dropdown-toggle" data-toggle="dropdown">
                                This month
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Jan</a>
                                <a class="dropdown-item" href="#">Feb</a>
                                <a class="dropdown-item" href="#">Mar</a>
                            </div>
                        </div>
                        <div class="d-flex cate justify-content-between p-3 pt-4">
                            <div>
                                <span>
                                    <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/top-arrow.png"
                                        alt="Img">
                                </span>
                            </div>
                            <div>
                                <h6>Income</h6>
                                <p>$51,900.00</p>
                            </div>
                            <div>
                                <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/chart1.png" alt="Img"
                                    width="55">
                            </div>
                        </div>
                        <div class="d-flex cate justify-content-between p-3 pt-4">
                            <div>
                                <span>
                                    <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/down-arrow.png"
                                        alt="Img">
                                </span>
                            </div>
                            <div>
                                <h6>Income</h6>
                                <p class="m-0">$51,900.00</p>
                            </div>
                            <div>
                                <img src="<?php echo BASE_URL ?>/public/admin/assets/img/icons/chart2.png" alt="Img"
                                    width="55">
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ Balence-->
            </div>
        </div>
        <!-- Income section-->

        <!-- Latest PAtients-->
        <div class="row">
            <div class="col-12">
                <h4 class="admin_title">NGƯỜI DÙNG MỚI NHẤT</h4>
                <div class="table-responsive">
                    <table class="table bg-white mb-0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Ngày tham gia</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($all_users as $user) {
                                if ($count == 5) {
                                    break;
                                }
                                if ($user["id"] != $_SESSION["UserID"]) {
                                    echo '  <tr>
                                    <td>00' . $count . '</td>
                                    <td>' . $user['user_name'] . '</td>
                                    <td>' . date('d/m/Y', strtotime($user["created_at"])) . '</td>
                                    <td>' . $user['email'] . '</td>
                                    <td>' . $user['phone_number'] . '</td>
                                    <td>
                                        <a href="' . BASE_URL . '/admin/users/edit/' . $user["id"] . '" class="px-2 edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="' . BASE_URL . '/admin/users/delete/' . $user["id"] . '" class="px-2 del"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>';
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Latest Patients-->
    </div>

    <!-- Notifications -->
    <div class="notification-box">
        <div class="msg-sidebar notifications msg-noti">
            <div class="topnav-dropdown-header">
                <span>Messages</span>
            </div>
            <div class="drop-scroll msg-list-scroll">
                <ul class="list-box">
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">R</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Richard Miles </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item new-message">
                                <div class="list-left">
                                    <span class="avatar">J</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">John Doe</span>
                                    <span class="message-time">1 Aug</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">T</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Tarah Shropshire </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">M</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Mike Litorus</span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">C</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Catherine Manseau </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">D</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Domenic Houston </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">B</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Buster Wigton </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">R</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Rolland Webber </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">C</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author"> Claire Mapes </span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">M</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Melita Faucher</span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">J</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Jeffery Lalor</span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">L</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Loren Gatlin</span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar">T</span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">Tarah Shropshire</span>
                                    <span class="message-time">12:28 AM</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="topnav-dropdown-footer">
                <a href="#">See all messages</a>
            </div>
        </div>
    </div>
    <!-- Notifications -->
</div>
<!--/ content -->