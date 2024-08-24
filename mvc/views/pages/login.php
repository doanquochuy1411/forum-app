<div class="account-page">
    <div class="account-center">
        <div class="account-box">
            <form action="<?php echo BASE_URL; ?>/login/HandelLogin" class="form-signin" method="post">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo-dark.png" alt="image"></a>
                </div>
                <div class="form-group">
                    <label>Tên tài khoản</label>
                    <input type="text" autofocus name="user_name" class="form-control" placeholder="Tên tài khoản">
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="form-group text-right">
                    <a href="<?php echo BASE_URL; ?>/reset">Quên mật khẩu?</a>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="btnLogin" class="btn btn-primary account-btn">Đăng nhập</button>
                </div>
                <div class="text-center register-link">
                    Bạn chưa có tài khoản? <a href="<?php echo BASE_URL; ?>/register">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</div>