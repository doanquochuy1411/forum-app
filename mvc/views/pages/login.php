<div class="account-page pd-t-90">
    <div class="account-center">
        <div class="account-box">
            <form action="<?php echo BASE_URL; ?>/login/HandelLogin" class="form-signin" method="post"
                onsubmit="return validateFormLogin()">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo.png" alt="image"
                            class="lg-auth"></a>
                </div>
                <div class="form-group mg-b-5">
                    <label>Tên tài khoản</label>
                    <input type="text" autofocus name="user_name" class="form-control" placeholder="Tên tài khoản">
                    <small id="user_name_err" class="alert-valid"></small>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                    <small id="password_err" class="alert-valid"></small>
                </div>
                <div class="form-group text-right">
                    <a href="<?php echo BASE_URL; ?>/reset">Quên mật khẩu?</a>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha"
                        data-sitekey="<?php echo isset($_SESSION["PUBLIC_KEY"]) ? $_SESSION["PUBLIC_KEY"] : "" ?>">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" name="btnLogin" type="submit">Đăng nhập</button>
                </div>

                <div class="text-center register-link">
                    Bạn chưa có tài khoản? <a href="<?php echo BASE_URL; ?>/register">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</div>