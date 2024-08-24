<div class="account-page">
    <div class="account-center">
        <div class="account-box">
            <form class="form-send-code" action="<?php echo BASE_URL; ?>/<?php echo $controller ?>/SendCode"
                method="post" onsubmit="return validateFormSendCode()">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo-dark.png" alt="Preadmin"></a>
                </div>
                <div class="form-group">
                    <label>Nhập email của bạn</label>
                    <input type="text" class="form-control" name="email" autofocus>
                    <small id="email_err"></small>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" name="btnSendCode" type="submit">Tiếp theo</button>
                </div>
                <div class="text-center register-link">
                    <a href="<?php echo BASE_URL; ?>/login">Quay lại trang đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>