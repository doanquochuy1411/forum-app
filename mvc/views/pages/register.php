<div class="account-page">
    <div class="account-center">
        <div class="account-box">
            <form class="form-signup-info" action="<?php echo BASE_URL; ?>/Register/HandelRegister" method="post"
                onsubmit="return validateFormHandelRegister()">
                <div class="account-logo">
                    <a href="<?php echo BASE_URL; ?>"><img
                            src="<?php echo BASE_URL; ?>/public/admin/assets/img/logo.png" alt="Preadmin"></a>
                </div>
                <input hidden type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($data) ?> ">
                <div class="form-group">
                    <label>Tên của bạn</label>
                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Tên người dùng"
                        autofocus>
                    <small id="full_name_err"></small>
                </div>
                <div class="form-group">
                    <label>Giới tính </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="Nam" id="gender_male" checked>
                        <label class="form-check-label" for="gender_male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="Nữ" id="gender_female">
                        <label class="form-check-label" for="gender_female">Nữ</label>
                    </div>
                    <small id="gender_err" style="color: red;"></small>
                </div>
                <div class="form-group">
                    <label>Tên tài khoản</label>
                    <input type="text" class="form-control" name="account_name" id="account_name"
                        placeholder="Tên tài khoản đăng nhập">
                    <small id="account_name_err"></small>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                    <small id="password_err"></small>
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu của bạn</label>
                    <input type="password" class="form-control" name="retype_password" id="retype_password"
                        placeholder="Xác nhận mật khẩu">
                    <small id="retype_password_err"></small>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" type="submit" name="btnRegister">Đăng ký</button>
                </div>
                <div class="text-center register-link">
                    <a href="<?php echo BASE_URL; ?>/login">Trở về đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>