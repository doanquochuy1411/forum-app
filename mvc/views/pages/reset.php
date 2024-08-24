<div class="account-page">
    <div class="account-center">
        <div class="account-box">
            <form class="form-signin" action="<?php echo BASE_URL; ?>/Reset/HandelReset" method="post">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo-dark.png" alt="Preadmin"></a>
                </div>
                <input hidden type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($data) ?> ">
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Mật khẩu mới">
                    <small id="password_err"></small>
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu của bạn</label>
                    <input type="password" class="form-control" name="retype_password" id="retype_password"
                        placeholder="Xác nhận mật khẩu">
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