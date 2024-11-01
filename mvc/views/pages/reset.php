<div class="account-page pd-t-90">
    <div class="account-center">
        <div class="account-box">
            <form class="form-signin" action="<?php echo BASE_URL; ?>/Reset/HandelReset" method="post"
                onsubmit="return validateFormResetPassword()">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo.png" class="lg-auth"
                            alt="Preadmin"></a>
                </div>
                <input hidden type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($data) ?> ">
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới"
                        onchange="validatePassword()">
                    <small id="password_err"></small>
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu của bạn</label>
                    <input type="password" class="form-control" name="retype_password" placeholder="Xác nhận mật khẩu"
                        onchange="validateRetypePassword()">
                    <small id="retype_password_err"></small>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" type="submit" name="btnReset">Khôi phục</button>
                </div>
                <div class="text-center register-link">
                    <a href="<?php echo BASE_URL; ?>/login">Quay lại trang đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>