<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/review.css" type="text/css">
    <!-- Dropdown menu -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/drop-down.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Load page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.css">
    <!-- <Link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/load_page.css" type="text/css"> -->
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Miễn phí vận chuyển cho đơn hàng từ 100.000đ</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__auth">
                                <?php
                                if (isset($_SESSION["UserID"])) {
                                    echo '<div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . $user_name . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Quản lý đơn hàng</a>
                                        <a class="dropdown-item" href="#">Cập nhật thông tin</a>
                                        <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                        <a class="dropdown-item" href="' . BASE_URL . '/Home/Logout">Đăng xuất</a>
                                    </div>
                                </div>';
                                } else {
                                    echo ' <div class="header__top__right__auth">
                                            <a href="' . BASE_URL . '/Login"><i class="fa fa-user"></i> Đăng nhập</a>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/public/img/logo.png"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?php echo BASE_URL; ?>">Trang chủ</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/Shop">Cửa hàng</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/Home/Redirect/blog">Blog</a></li>
                            <li><a href="#">Thông tin</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="<?php echo BASE_URL; ?>/Cart">Giỏ hàng</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>/Home/Redirect/blog-details">Chi tiết Blog</a>
                                    </li>
                                    <li><a href="<?php echo BASE_URL; ?>/Checkout">Thanh toán</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>/Home/Redirect/contact">Liên hệ</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>/Cart"><i class="fa fa-shopping-bag"></i> <span>
                                        <?php
                                        echo $amount_cart
                                            ?>
                                    </span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng tiền: <span>
                                <?php
                                echo number_format($total, 0, '', '.')
                                    ?>
                                đ</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Content -->
    <div id="content">
        <!-- Hero Section Begin -->
        <section class="hero <?php echo $Page == "home" ? "" : "hero-normal" ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>DANH MỤC</span>
                            </div>
                            <ul>
                                <?php
                                foreach ($category_list as $category) {
                                    echo "<li><a href='" . BASE_URL . '/Shop/Categories/' . $category["id"] . "'>" . $category["name"] . "</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="<?php echo BASE_URL . '/Shop/HandleSearchProducts' ?>" method="post"
                                    onsubmit="return validateForm()">
                                    <input type="text" id="product_name" name="product_name"
                                        placeholder="Bạn cần tìm hạt giống gì?">
                                    <button type="submit" name="btnSearch" class="site-btn">TÌM KIẾM</button>
                                </form>
                            </div>
                            <div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>031 188 888</h5>
                                    <span>Hỗ trợ 24/7</span>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo $Page != "home" ? "" : '<div class="hero__item set-bg" data-setbg="' . BASE_URL . '/public/img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>HẠT GIỐNG TƯƠI TỐT</span>
                            <h2>Rau Củ <br />100% Hữu Cơ</h2>
                            <p>Giao hàng miễn phí và nhanh chóng</p>
                            <a href="#" class="primary-btn">MUA NGAY</a>
                        </div>
                    </div>';
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
        <?php
        require_once "./mvc/views/pages/" . $Page . ".php";
        ?>
    </div>
    <!-- Content -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="<?php echo BASE_URL; ?>/public/index.html"><img
                                    src="<?php echo BASE_URL; ?>/public/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: 12 Nguyễn Văn bảo, P4, Quận Gò Vấp, Thành phố Hồ Chí Minh</li>
                            <li>Số điện thoại: 031-8888-899</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Liên kết hữu ích</h6>
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>">Trang chủ</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/shop-grid.html">Cửa hàng</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/blog.html">Blog</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/contact.html">Liên hệ</a></li>
                        </ul>
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>/public/shop-details.html">Chi tiết cửa hàng</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/shoping-cart.html">Giỏ hàng</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/checkout.html">Thanh toán</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/blog-details.html">Chi tiết Blog</a></li>
                            <li><a href="<?php echo BASE_URL; ?>/public/contact.html">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Tham gia cùng chúng tôi</h6>
                        <p>Để lại email để nhận được thông tin mới nhất và các ưu đãi nhé !</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập email của bạn">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> Bản quyền © | Website được cung cấp bởi <i class="fa fa-seedling"
                                    aria-hidden="true"></i>
                                <a href="https://yourwebsite.com" target="_blank">Công Ty Hạt Giống</a>.
                                Thiết kế với <i class="fa fa-heart" aria-hidden="true"></i> bởi <a
                                    href="https://colorlib.com" target="_blank">Colorlib</a>
                            </p>
                        </div>

                        <div class="footer__copyright__payment"><img
                                src="<?php echo BASE_URL; ?>/public/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="<?php echo BASE_URL; ?>/public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/jquery-ui.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/jquery.slicknav.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/mixitup.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/cart.js"></script>

    <!-- Dropdown menu -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function validateForm() {
            var productName = document.getElementById("product_name").value.trim();
            if (productName === "") {
                alert("Vui lòng nhập tên sản phẩm cần tìm!");
                return false;
            }
            return true;
        }
    </script>

    <!-- Handel Add to Cart -->
    <script>
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                // Ngăn chặn hành vi mặc định của link

                const quantityInput = document.querySelector(
                    ".product__details__quantity .quantity .pro-qty .quantity-input");
                const quantity = quantityInput.value;
                console.log("quantity: " + quantity);

                // Cập nhật URL
                button.href =
                    `<?php echo BASE_URL; ?>/Cart/AddToCart/${button.dataset.productId}/${quantity}`;

                // Bây giờ bạn có thể cho phép chuyển hướng
                window.location.href = button.href;
            });
        });
    </script>

</body>

</html>