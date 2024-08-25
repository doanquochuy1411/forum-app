<div class="account-page">
    <div class="account-center">
        <div class="account-box">
            <form class="form-signin" action="<?php echo BASE_URL; ?>/<?php echo $controller ?>/VerifyCode"
                method="post">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo.png" alt="Preadmin"></a>
                </div>
                <input hidden type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($data) ?> ">
                <div class="form-group">
                    <label>Nhập mã xác minh</label>
                    <input type="text" class="form-control" name="code" autofocus>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" name="btnVerifyCode" type="submit">Tiếp theo</button>
                </div>
                <div class="text-center register-link">
                    <a href="<?php echo BASE_URL; ?>/login">Quay lại trang đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>