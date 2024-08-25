<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Ask online Form">
    <!-- <meta name="description"
        content="The Ask is a bootstrap design help desk, support forum website template coded and designed with bootstrap Design, Bootstrap, HTML5 and CSS. Ask ideal for wiki sites, knowledge base sites, support forum sites">
     -->
    <meta name="keywords"
        content="HTML, CSS, JavaScript,Bootstrap,js,Forum,webstagram ,webdesign ,website ,web ,webdesigner ,webdevelopment">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <title>Ask Me</title>
    <link href="<?php echo BASE_URL; ?>/public/client/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/style.css" rel="stylesheet" type="text/css">
    <!-- <link href="<?php echo BASE_URL; ?>/public/client/css/animate.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo BASE_URL; ?>/public/client/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/footer.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>/public/client/css/sidebar.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- ==========header mega navbar=======-->
    <div class="top-menu-bottom932">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle
                        navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#"><img src="<?php echo BASE_URL; ?>/public/client/image/logo.png"
                        alt="Logo"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav"> </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Trang chủ</a></li>
                    <!-- <li><a href="ask_question.html">Giới thiệu</a></li> -->
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Diễn đàn <span class="caret"></span></a>
                        <ul class="dropdown-menu animated zoomIn">
                            <li><a href="category.html">Question Category</a></li>
                            <li><a href="category.html">HTML</a></li>
                            <li><a href="category.html">CSS</a></li>
                            <li><a href="category.html">Javascript</a></li>
                            <li><a href="category.html">Bootstrap</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Hỏi đáp <span class="caret"></span></a>
                        <ul class="dropdown-menu animated zoomIn">
                            <li><a href="category.html">Question Category</a></li>
                            <li><a href="category.html">HTML</a></li>
                            <li><a href="category.html">CSS</a></li>
                            <li><a href="category.html">Javascript</a></li>
                            <li><a href="category.html">Bootstrap</a></li>
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
                                <form class="navbar-form" role="search">
                                    <div class="input-group add-on">
                                        <input class="form-control form-control222" placeholder="Tìm kiếm"
                                            id="srch-term" type="text">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default btn-default2913" type="button"><i
                                                    class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/Login"><i class="fa fa-user" aria-hidden="true"></i> Đăng
                            nhập</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            </>
            <!-- /.container-fluid -->
        </nav>
    </div>


    <?php
    require_once "./mvc/views/pages/" . $Page . ".php";
    ?>

    <!--    footer -->
    <div class="footer-search">
        <div class="container">
            <div class="row">
                <div id="custom-search-input">
                    <div class="input-group col-md-12"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        <input type="text" class="  search-query form-control user-control30"
                            placeholder="Search here...." /> <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <span class=" glyphicon glyphicon-search"></span> </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
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
                        function formatVietnameseDate($dateString)
                        {
                            $timestamp = strtotime($dateString);

                            $formattedDate = 'Ngày ' . date('d', $timestamp) . ' tháng ' . date('m', $timestamp) . ', ' . date('Y', $timestamp);

                            return $formattedDate;
                        }

                        $counter = 0; // Biến đếm để theo dõi số phần tử đã lặp qua
                        
                        foreach ($questions as $question) {
                            if ($counter >= 3) {
                                break; // Thoát khỏi vòng lặp nếu đã lặp qua 3 phần tử
                            }

                            $originalDate = '2024-05-25';
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
                            <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck cập
                                    nhật mới #AskMe #ThemeForest #WordPress #2code #Envato#2code
                                    Themehttps://t.co/urb3LgsOCi</a></p> <small>khoảng 2 tuần trước</small>
                        </div>
                        <div class="tweet-details29">
                            <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck cập
                                    nhật mới #AskMe #ThemeForest #WordPress #2code #Envato#2code
                                    Themehttps://t.co/urb3LgsOCi</a></p> <small>khoảng 2 tuần trước</small>
                        </div>
                        <div class="tweet-details29">
                            <p><i class="fa fa-twitter-square" aria-hidden="true"></i><a href="#"> codeThemesCheck cập
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
                                aria-hidden="true"></i></a> <a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/npm.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/footer.js"></script>
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

            var retypePasswordInput = document.querySelector('input[name="retype_password"]');
            if (retypePasswordInput) {
                retypePasswordInput.addEventListener('input', validateRetypePassword);
            }
        });
    </script>
</body>

</html>