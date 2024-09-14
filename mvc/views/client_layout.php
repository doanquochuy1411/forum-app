<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Diễn Đàn IT - IUH">
    <!-- <meta name="description"
        content="The Ask is a bootstrap design help desk, support forum website template coded and designed with bootstrap Design, Bootstrap, HTML5 and CSS. Ask ideal for wiki sites, knowledge base sites, support forum sites">
     -->
    <meta name="keywords"
        content="HTML, CSS, JavaScript,Bootstrap,js,Forum,webstagram ,webdesign ,website ,web ,webdesigner ,webdevelopment">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <!-- logo -->
    <link rel="icon" href="<?php echo BASE_URL; ?>/public/admin/assets/img/logo-iuh.ico" type="image/x-icon">
    <!-- Title web -->
    <title>Diễn Đàn IT - IUH</title>
    <link href="<?php echo BASE_URL; ?>/public/client/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/style.css" rel="stylesheet" type="text/css">
    <!-- <link href="<?php echo BASE_URL; ?>/public/client/css/animate.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo BASE_URL; ?>/public/client/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/footer.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/sidebar.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/avt-header.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/pusher.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/admin/assets/css/loading.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <!-- Popup thông báo -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        #editor {
            height: 300px;
            margin-top: 20px;
        }

        .dropdown-menu>li:first-child>a:hover,
        .dropdown-menu>li:first-child>a:focus {
            color: #000;
            background-color: #fff !important;

        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>


<body>
    <span class="loader"></span>
    <div class="hidden-content">
        <!-- ==========header mega navbar=======-->
        <div class=" top-menu-bottom932">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle
                            navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL ?>"><img
                            src="<?php echo BASE_URL; ?>/public/client/image/logo.png" alt="Logo"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav"> </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
                        <!-- <li><a href="ask_question.html">Giới thiệu</a></li> -->
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Diễn đàn
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu animated zoomIn">
                                <?php
                                if (count($categories) > 0) {
                                    echo '<li><a href="' . BASE_URL . '/home/allPosts/post">Tất cả</a></li>';
                                    foreach ($categories as $category) {
                                        echo '<li><a href="' . BASE_URL . '/home/categories/' . $category['id'] . '/post">' . $category['name'] . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Hỏi đáp <span class="caret"></span></a>
                            <ul class="dropdown-menu animated zoomIn">
                                <?php
                                if (count($categories) > 0) {
                                    echo '<li><a href="' . BASE_URL . '/home/allPosts/question">Tất cả</a></li>';
                                    foreach ($categories as $category) {
                                        echo '<li><a href="' . BASE_URL . '/home/categories/' . $category['id'] . '/question">' . $category['name'] . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </li>

                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Blog <span class="caret"></span></a>
                            <ul class="dropdown-menu animated zoomIn">
                                <li><a href="blog.html">Blog </a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="col-md-12">
                                <div class="navbar-serch-right-side">
                                    <form class="navbar-form" role="search" id="searchForm" method="post"
                                        action="<?php echo BASE_URL ?>/home/search" id="formSearch"
                                        onsubmit="return validateFormSearch()">
                                        <div class="input-group add-on">
                                            <input class="form-control form-control222" placeholder="Tìm kiếm"
                                                id="srch-term" type="text" name="txtSearch">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default btn-default2913" type="submit"
                                                    name="btnSearch"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>

                        <!-- Thêm icon chuông và dropdown thông báo -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle un-hover" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <span class="badge" style="position: relative; top: -9px; background-color:red">0</span>
                                <!-- Số lượng thông báo -->
                            </a>
                            <ul class="dropdown-menu animated zoomIn" id="notification-dropdown">
                                <li class="dropdown-header">
                                    <h5 style="font-size: large; margin-bottom: 0">Thông báo</h5>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Xem tất cả thông báo</a></li>
                            </ul>
                        </li>

                        <!-- User menu -->
                        <li class="nav-item dropdown">
                            <?php
                            if (isset($_SESSION["UserID"])) {
                                $image = $_SESSION["Avatar"];
                                echo '<li class="dropdown"> <a href="' . BASE_URL . '/home/info/' . $_SESSION["AccountName"] . '" class="dropdown-toggle avt-user" data-toggle="dropdown"><img src="' . BASE_URL . '/public/src/uploads/' . $image . '" alt="Avatar"></span></a>
                            <ul class="dropdown-menu animated zoomIn">
                                <li><a href="' . BASE_URL . '/home/info/' . $_SESSION["AccountName"] . '"><img src="' . BASE_URL . '/public/src/uploads/' . $image . '" alt="Avatar"> <b>' . $_SESSION["UserName"] . '</b></a></li>
                                <hr>
                                <li><a href="' . BASE_URL . '/home/info/' . $_SESSION["AccountName"] . '">Trang cá nhân</a></li>
                                <li><a href="#" id="openChangePasswordModal">Đổi mật khẩu</a></li>
                                <li><a href="' . BASE_URL . '/home/logout">Đăng xuất</a></li>
                            </ul>
                        </li>';

                                echo '<div class="modal fade" id="change-password" tabindex="-1" role="dialog"
                        aria-labelledby="edit-user-modal-label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h3 style="text-align: center" class="modal-title" id="edit-user-modal-label"><b>Đổi Mật Khẩu</b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-user-form" action="' . BASE_URL . '/users/changePassword" method="post"
                                        onsubmit="return validateFormChangePassword()">
                                        <div class="form-group">
                                            <label for="current_password">Mật khẩu hiện tại:</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <small id="current_password_err"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">Mật khẩu mới:</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                            <small id="new_password_err"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="retype_password">Nhập lại mật khẩu:</label>
                                            <input type="password" class="form-control" id="retype_password_of_change" name="retype_password_of_change">
                                            <small id="retype_password_of_change_err"></small>
                                        </div>
                                        <input type="hidden" name="token" value="' . $_SESSION['_token'] . '" />
                                        <button type="submit" name="btnChangePassword" class="btn btn-primary">Lưu thay đổi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                            } else {
                                echo '<a href="' . BASE_URL . '/Login"><i class="fa fa-user" aria-hidden="true"></i> Đăng
                                nhập</a>';
                            }
                            ?>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- /.container-fluid -->
            </nav>
        </div>


        <?php
        require_once "./mvc/views/pages/" . $Page . ".php";
        ?>

        <!--    footer -->
        <div class="footer-search">
        </div>
        <section class="footer-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-part-one320">
                            <!-- <h4>Chúng tôi ở đâu?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit
                                amet suscipit risus ultrices eu.</p> -->
                            <h4>Địa chỉ:</h4>
                            <p>12 Nguyễn Văn Bảo, P4, Quận Gò Vấp <br>Thành phố Hồ Chí Minh.
                            </p>
                            <h4>Hỗ trợ:</h4>
                            <p>Số điện thoại hỗ trợ: 0366 555 444</p>
                            <p>Email hỗ trợ:</p>
                            <p>hotro@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-part-two320">
                            <h4>Liên kết nhanh</h4>
                            <a href="#">
                                <p>- Trang chủ</p>
                            </a>
                            <a href="#">
                                <p>- Đặt câu hỏi</p>
                            </a>
                            <a href="#">
                                <p>- Các câu hỏi</p>
                            </a>
                            <a href="#">
                                <p>- Người dùng</p>
                            </a>
                            <a href="#">
                                <p>- Chỉnh sửa hồ sơ</p>
                            </a>
                            <a href="#" class="last-child12892">
                                <p>- Liên hệ chúng tôi</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-part-three320">
                            <h4>Các câu hỏi phổ biến</h4>
                            <?php

                            $counter = 0; // Biến đếm để theo dõi số phần tử đã lặp qua
                            
                            foreach ($questions as $question) {
                                if ($counter >= 3) {
                                    break; // Thoát khỏi vòng lặp nếu đã lặp qua 3 phần tử
                                }

                                // $originalDate = '2024-05-25';
                                $formattedDate = formatVietnameseDate($question['created_at']);
                                echo '<div class="news-info209">
                                <h5>' . $question['title'] . '</h5>
                                <p>' . $question['content'] . '</p> <small>' . $formattedDate . '</small>
                            </div>';
                                $counter++; // Tăng biến đếm lên 1 sau mỗi lần lặp
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-part-four320">
                            <h4>Tweet mới nhất</h4>
                            <div class="tweet-details29">
                                <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck
                                        cập
                                        nhật mới #AskMe #ThemeForest #WordPress #2code #Envato#2code
                                        Themehttps://t.co/urb3LgsOCi</a></p> <small>khoảng 2 tuần trước</small>
                            </div>
                            <div class="tweet-details29">
                                <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck
                                        cập
                                        nhật mới #AskMe #ThemeForest #WordPress #2code #Envato#2code
                                        Themehttps://t.co/urb3LgsOCi</a></p> <small>khoảng 2 tuần trước</small>
                            </div>
                            <div class="tweet-details29">
                                <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck
                                        cập
                                        nhật mới #AskMe #ThemeForest #WordPress #2code #Envato#2code
                                        Themehttps://t.co/urb3LgsOCi</a></p> <small>khoảng 2 tuần trước</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer-social">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Bản quyền © 2017 Ask me | <strong>Sudo Coder</strong></p>
                    </div>
                    <div class="col-md-6">
                        <div class="social-right2389"> <a href="#"><i class="fa fa-twitter-square"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-facebook"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-youtube"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-skype"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin"
                                    aria-hidden="true"></i></a> <a href="#"><i class="fa fa-rss"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/npm.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/footer.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/loading.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/validate.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var emailInput = document.querySelector('input[name="email"]');
            if (emailInput) {
                emailInput.addEventListener('input', validateEmail);
            }

            var fullNameInput = document.querySelector('input[name="full_name"]');
            if (fullNameInput) {
                fullNameInput.addEventListener('input', validateFullName);
            }

            var userNameInput = document.querySelector('input[name="user_name"]');
            if (userNameInput) {
                userNameInput.addEventListener('input', validateUserName);
            }

            var accountNameInput = document.querySelector('input[name="account_name"]');
            if (accountNameInput) {
                accountNameInput.addEventListener('input', validateAccountName);
            }

            var passwordInput = document.querySelector('input[name="password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', validatePassword);
            }

            var passwordInput = document.querySelector('input[name="current_password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', validateCurrentPassword);
            }

            var passwordInput = document.querySelector('input[name="new_password"]');
            if (passwordInput) {
                passwordInput.addEventListener('input', validateNewPassword);
            }

            var retypePasswordInput = document.querySelector('input[name="retype_password"]');
            if (retypePasswordInput) {
                retypePasswordInput.addEventListener('input', validateRetypePassword);
            }

            var retypePasswordInput = document.querySelector('input[name="retype_password_of_change"]');
            if (retypePasswordInput) {
                retypePasswordInput.addEventListener('input', validateRetypePasswordOfChangePass);
            }

            var title = document.querySelector('input[name="title"]');
            if (title) {
                title.addEventListener('input', validateTitleOfPost);
            }

            var phoneNumber = document.querySelector('input[name="phone_number"]');
            if (phoneNumber) {
                phoneNumber.addEventListener('input', validatePhoneNumber);
            }
        });
    </script>
    <!-- Trình soạn thảo -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.core.js"></script> -->
    <script>
        if (document.querySelector('#editor')) {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'header': '1'
                        }, {
                            'header': '2'
                        }, {
                            'font': []
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'align': []
                        }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            // Gán nội dung từ biến PHP vào Quill editor
            var existingContent = `<?php echo isset($post_to_edit[0]["content"]) ? $post_to_edit[0]["content"] : "" ?>`;
            quill.root.innerHTML = existingContent; // Đưa nội dung vào trình soạn thảo

            // Gán nội dung của trình soạn thảo vào trường ẩn trước khi gửi form
            document.getElementById('postForm').addEventListener('submit', function (event) {
                // Cập nhật nội dung của trường ẩn
                document.getElementById('editorContent').value = quill.root.innerHTML;

                // var editorContent = document.getElementById('editorContent').value.trim();
                var editorContent = quill.root.innerHTML.trim();
                if (editorContent === '' || editorContent === '<p><br></p>' || editorContent.length < 100) {
                    event.preventDefault(); // Ngăn chặn việc gửi form
                    document.getElementById('editorContent_err').textContent =
                        'Nội dung phải có ít nhất 100 ký tự.';
                    document.getElementById('editorContent_err').style.color = 'red'
                } else {
                    document.getElementById('editorContent_err').textContent = '';
                }

            });

            // <!-- tags -->
            document.addEventListener('DOMContentLoaded', function () {
                const tagsInput = document.getElementById('tagsInput');
                const tagsInputContainer = document.getElementById('tagsInputContainer');
                const hiddenTagsContainer = document.getElementById('hiddenTagsContainer');
                let tags = [];

                tagsInput.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Ngăn chặn hành vi Enter mặc định
                        if (tags.length < 10) {
                            const tagText = tagsInput.value.trim();
                            if (tagText !== '' && !tags.includes(tagText)) {
                                addTag(tagText);
                                tags.push(tagText);
                                tagsInput.value = '';
                                updateHiddenTags(); // Cập nhật các input ẩn
                            }
                        }
                    }
                });

                function addTag(tagText) {
                    const tagElement = document.createElement('span');
                    tagElement.className = 'badge badge-primary mx-1 tags';
                    tagElement.innerHTML = `${tagText} <button type="button" class="close" aria-label="Close" onclick="removeTag('${tagText}')">
                                        <span aria-hidden="true">&times;</span>
                                      </button>`;
                    tagsInputContainer.insertBefore(tagElement, tagsInput);
                }

                window.removeTag = function (tagText) {
                    tags = tags.filter(tag => tag !== tagText);
                    const tagElements = tagsInputContainer.getElementsByClassName('badge');
                    for (let i = 0; i < tagElements.length; i++) {
                        if (tagElements[i].textContent.includes(tagText)) {
                            tagsInputContainer.removeChild(tagElements[i]);
                            break;
                        }
                    }
                    updateHiddenTags(); // Cập nhật các input ẩn sau khi xóa tag
                }

                function updateHiddenTags() {
                    // Xóa tất cả các input ẩn cũ
                    hiddenTagsContainer.innerHTML = '';

                    // Tạo lại các input ẩn mới
                    tags.forEach(tag => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'tags[]';
                        hiddenInput.value = tag;
                        hiddenTagsContainer.appendChild(hiddenInput);
                    });
                }
            });
        } else {
            console.warn("Element #editor not found in the DOM.");
        }
    </script>
    <!-- SweetAlert2 JS -->
    <!-- popup thông báo -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        var title_mess = "<?php echo isset($_SESSION['title_message']) ? $_SESSION['title_message'] : "" ?>";
        var text_mes = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : "" ?>";

        function showSuccessNotification() {
            Swal.fire({
                icon: 'success',
                title: title_mess,
                text: text_mes,
                timer: 2000,
                timerProgressBar: true
            });
        }

        function showFailNotification() {
            Swal.fire({
                icon: 'error',
                title: title_mess,
                text: text_mes,
                timer: 3000,
                timerProgressBar: true
            });
        }

        <?php
        $status = isset($_SESSION['action_status']) ? $_SESSION['action_status'] : "";
        switch ($status) {
            case 'success':
                echo 'showSuccessNotification();';
                $_SESSION['action_status'] = 'none';
                $_SESSION['title_message'] = '';
                $_SESSION['message'] = '';
                break;
            case 'error':
                echo 'showFailNotification();';
                $_SESSION['action_status'] = 'none';
                $_SESSION['title_message'] = '';
                $_SESSION['message'] = '';
                break;
            default:
                echo '';
                break;
        }
        ?>
    </script>

    <script>
        function confirmDelete(event, targetHref) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            Swal.fire({
                title: "Bạn có chắc chắn xóa không",
                width: '400px', // Tăng chiều rộng của popup
                confirmButtonText: "Xóa",
                // denyButtonText: `Don't save`,
                // showDenyButton: true,
                showCancelButton: true,
                // customClass: {
                //     title: 'swal2-title-large', // Kích thước chữ tiêu đề
                //     popup: 'swal2-popup-large', // Kích thước văn bản trong popup
                //     confirmButton: 'swal2-button-large', // Kích thước chữ nút xác nhận
                //     denyButton: 'swal2-button-large', // Kích thước chữ nút từ chối
                //     cancelButton: 'swal2-button-large' // Kích thước chữ nút hủy
                // }
            }).then((result) => {
                if (result.isConfirmed) {
                    targetHref = targetHref + "/<?php echo $_SESSION['_token'] ?? '' ?>"
                    // console.log("href: ", targetHref);
                    window.location.href = targetHref;
                    // window.location.href = event.target.href;
                    // Swal.fire("Xóa thành công!", "", "success");
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    </script>
    <script>
        // Search ở trang body trang hompage
        function handleSearchLink(event) {
            // Ngăn chặn hành động mặc định của thẻ <a>
            event.preventDefault();

            // Thực hiện hành động khi nhấp vào thẻ <a>
            console.log('Thẻ <a> đã được nhấp.');

            // Lấy phần tử input bằng id
            var inputElement = document.getElementById('txtSearch_body');

            // Kiểm tra xem phần tử có tồn tại không
            if (inputElement) {
                // Lấy giá trị của input
                // var inputValue = inputElement.value;
                var input = document.getElementById('srch-term');
                var form = document.getElementById('searchForm');

                input.value = inputElement.value;
                console.log('Giá trị của input là:', input.value);

                var submitButton = form.querySelector('button[name="btnSearch"]');

                if (submitButton) {
                    submitButton.click(); // Giả lập việc nhấn nút submit
                }
            } else {
                console.error('Phần tử input không tồn tại');
            }

            // Nếu có một form và bạn muốn gửi nó
            // var form = document.getElementById('myForm');
            // if (form) {
            //     form.submit(); // Hoặc thực hiện các hành động khác
            // } else {
            //     console.error('Form không tồn tại');
            // }
        }
    </script>
    <!-- popup -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editIcon = document.querySelector('.edit-icon');
            var popup = document.getElementById('edit-popup');
            var close = document.querySelector('.close');

            if (editIcon) { // Kiểm tra nếu phần tử tồn tại
                editIcon.addEventListener('click', function (event) {
                    event.preventDefault();
                    popup.style.display = 'flex';
                });
            }
            if (close) {
                close.addEventListener('click', function () {
                    popup.style.display = 'none';
                });
            }

            window.addEventListener('click', function (event) {
                if (event.target == popup) {
                    popup.style.display = 'none';
                }
            });
        });
    </script>
    <!-- popup change password -->
    <script>
        $(document).ready(function () {
            // Khi người dùng nhấn vào nút "Đổi Mật Khẩu"
            $('#openChangePasswordModal').on('click', function () {
                // Hiển thị modal popup
                $('#change-password').modal('show');
            });
        });

        $(document).ready(function () {
            // Khi người dùng nhấn vào nút "Báo cáo"
            $('#openReportModal').on('click', function () {
                // Hiển thị modal popup
                $('#report').modal('show');
            });
        });
    </script>

    <!-- Pusher Thông báo realtime -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/pusher.js"></script>

</body>

</html>