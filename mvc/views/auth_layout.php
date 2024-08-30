<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preadmin - Bootstrap Admin Template</title>

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/public/admin/assets/img/favicon.ico">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet"
        href="<?php echo BASE_URL; ?>/public/admin/assets/plugins/fontawesome/css/fontawesome.min.css">

    <!--custom styles-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/admin/assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css"
        integrity="sha256-KIZHD6c6Nkk0tgsncHeNNwvNU1TX8YzPrYn01ltQwFg=" crossorigin="anonymous">
    <link href="<?php echo BASE_URL; ?>/public/admin/assets/css/loading.css" rel="stylesheet" type="text/css">

</head>


<body>
    <span class="loader"></span>
    <div class="hidden-content">
        <!-- Main Wrapper -->
        <div class="main-wrapper account-wrapper">
            <?php
            require_once "./mvc/views/pages/" . $Page . ".php";
            ?>
        </div>
        <!--/ Main Wrapper -->
    </div>

    <!--scripts-->
    <!-- jQuery -->
    <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/app.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/client/js/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"
        integrity="sha256-rTq0xiLu1Njw5mB3ky3DZhpI5WhYdkNlQbGXUc0Si6E=" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL; ?>/public/admin/assets/js/loading.js"></script>
</body>

</html>