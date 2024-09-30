<!--content-->
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <!-- <h4 class="page-title">Người dùng</h4> -->
                <h3 class="text-primary font-weight-bold position-relative">Người Dùng</h3>
                <div class="title-underline"></div>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="#" class="btn btn btn-primary btn-rounded float-right" id="openAddUserModal"><i
                        class="fa fa-plus"></i> Thêm người
                    dùng</a>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable m-b-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ Tên</th>
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
                                        echo '<tr>
                                        <td>' . $count . '</td>
                                            <td><b><a style="color: #000" href="' . BASE_URL . '/home/info/' . $_SESSION["AccountName"] . '"><img width="28" height="28"
                                                    src="' . BASE_URL . '/public/src/uploads/' . $user['image'] . '"
                                    class="rounded-circle m-r-5" alt="Img"> ' . $user['user_name'] . '</a></b></td>
                                    <td>' . date('d/m/Y', strtotime($user["created_at"])) . '</td>
                                    <td>' . $user['email'] . '</td>
                                    <td>' . $user['phone_number'] . '</td>
                                    <td>
                                        <a href="#" class="px-2 edit"></a>
                                        <a href="#" style="color: red" title="Xóa thành viên"><i class="fa fa-trash-alt" onclick="confirmDelete(event,\'' . BASE_URL . '/admin/deleteUser/' . $user['id'] . '\')"></i></a>
                                        </td>
                                    </tr>';
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Notification box-->
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
                </ul>
            </div>
            <div class="topnav-dropdown-footer">
                <a href="#">See all messages</a>
            </div>
        </div>
    </div>
    <!--Notification box-->

</div>
<!--/ content-->