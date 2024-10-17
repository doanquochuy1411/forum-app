<?php
class Register extends Controller
{
    public $UserModel;

    public $layout = "auth_layout";
    public $title = "Đăng ký";

    public $ctr = "Register";

    public function __construct()
    {
        $this->UserModel = $this->model("User");
    }

    function Index()
    {
        $this->view($this->layout, [
            "Page" => "send_code",
            "title" => $this->title,
            "controller" => $this->ctr
        ]);
    }

    function SendCode()
    {
        if (isset($_POST["btnSendCode"])) {
            $email = strtolower(trim($_POST["email"]));

            if (!validateEmail($email)) {
                // echo "<script>alert('Email không hợp lệ!'); history.back();</script>";
                $title = 'Yêu cầu gửi mã xác thực thất bại!';
                $message = 'Email không hợp lệ!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
                // return;
            }

            $userAccount = $this->UserModel->GetUserByEmail($email);
            if ($userAccount) {
                // echo "<script>alert('Email đã được đăng ký!'); history.back();</script>";
                $title = 'Yêu cầu gửi mã xác thực thất bại!';
                $message = 'Email đã được sử dụng!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
            }

            if (sendCode($email)) {
                $this->view($this->layout, [
                    "Page" => "verify_code",
                    "title" => $this->title,
                    "data" => $email,
                    "controller" => $this->ctr
                ]);
            }
        }
    }
    function VerifyCode()
    {
        if (isset($_POST["btnVerifyCode"])) {
            $email = strtolower(trim($_POST["email"]));
            $code = $_POST["code"];

            if (!verifyCode($email, $code)) {
                $this->view($this->layout, [
                    "Page" => "verify_code",
                    "title" => $this->title,
                    "data" => $email,
                    "controller" => $this->ctr
                ]);
                return;
            }

            $this->response($this->layout, "register", $this->title, $email);
        }
    }

    function HandelRegister()
    {
        if (isset($_POST["btnRegister"])) {
            $full_name = $_POST["full_name"];
            $account_name = htmlspecialchars(strtolower(trim($_POST["account_name"])));
            $email = strtolower(trim($_POST["email"]));
            $password = $_POST["password"];
            $retypePassword = $_POST["retype_password"];

            $errors = validateForm(["full_name", "account_name", "password"]);
            if (!empty($errors)) {
                // echo "<script>alert('Error: " . implode(", ", $errors) . "');</script>";
                $title = 'Đăng ký thất bại!';
                $message = 'Dữ liệu đăng ký không hợp lệ: ' . implode(", ", $errors);
                response_error($title, $message);
                $this->view($this->layout, [
                    "Page" => "register",
                    "title" => $this->title,
                    "data" => $email
                ]);
                return;
            }

            $userAccount = $this->UserModel->CheckAccountName($account_name);
            if ($userAccount) {
                $title = 'Đăng ký thất bại!';
                $message = 'Tên tài khoản đã được sử dụng!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
            }


            if ($password != $retypePassword) {
                // echo "<script>alert('Password and retype password do not matching');</script>";
                $title = 'Đăng ký thất bại!';
                $message = 'Mật khẩu và xác nhận mật khẩu không trùng khớp';
                response_error($title, $message);
                $this->view($this->layout, [
                    "Page" => "register",
                ]);
                return;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->UserModel->CreateUser($account_name, $full_name, $email, $hashedPassword);
            if ($result) {
                $userAccount = $this->UserModel->GetUserByEmail($email);
                $this->UserModel->SetRole($userAccount["id"], "2");
                // 1: admin
                // 2: customer
                $title = 'Đăng ký thành công!';
                $message = '';
                response_success($title, $message);
                $this->response($this->layout, "login", $this->title, [$email, $password]);
            } else {
                // echo "<script>alert('Fail to register');</script>";
                $title = 'Đăng ký thất bại!';
                $message = 'Lỗi hệ thống!';
                response_error($title, $message);
                $this->view($this->layout, [
                    "Page" => "register",
                ]);
                return;
            }
        }
    }
}
?>