<?php
class Reset extends Controller
{
    public $UserModel;

    public $layout = "auth_layout";
    public $title = "Quên mật khẩu";
    public $ctr = "Reset";



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
                echo "<script>alert('Email không hợp lệ!'); history.back();</script>";
                return;
            }

            $userAccount = $this->UserModel->GetUserByEmail($email);
            if ($userAccount == null) {
                echo "<script> alert('Email chưa được đăng ký'); history.back();</script>";
                // $this->view($this->layout, [
                //     "Page" => "send_code",
                //     "title" => $this->title,
                //     "data" => $email,
                //     "controller" => $this->ctr
                // ]);
                return;
            }

            if (sendCode($email)) {
                // $this->response($this->layout, "verify_code", $this->title, $email);
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

            if (!verifyCode($code)) {
                echo "<script>alert('Mã xác minh không chính xác!');</script>";
                // $this->response($this->layout, "verify_code", $this->title, $email);
                $this->view($this->layout, [
                    "Page" => "verify_code",
                    "title" => $this->title,
                    "data" => $email,
                    "controller" => $this->ctr
                ]);
                return;
            }

            $this->response($this->layout, "reset", $this->title, $email);
        }
    }

    function HandelReset()
    {
        if (isset($_POST["btnReset"])) {
            $email = strtolower(trim($_POST["email"]));
            $password = $_POST["password"];
            $retypePassword = $_POST["retype_password"];

            if (!validatePassword($password)) {
                echo "<script>alert('Mật khẩu không hợp lệ!');</script>";
                $this->view($this->layout, [
                    "Page" => "reset",
                    "title" => $this->title,
                    "data" => $email
                ]);
                return;
            }

            if ($password != $retypePassword) {
                echo "<script>alert('Password and retype password do not matching');</script>";
                $this->view($this->layout, [
                    "Page" => "reset",
                ]);
                return;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->UserModel->UpdatePassword($email, $hashedPassword);
            if ($result) {
                $this->UserModel->ResetLoginAttemptsWithEmail($email);
                $this->UserModel->ResetLockedWithEmail($email);
                echo "<script>alert('Khôi phục mật khẩu thành công');</script>";
                $this->response($this->layout, "login", $this->title, [$email, $password]);
            } else {
                echo "<script>alert('Khôi phục mật khẩu thất bại');</script>";
                $this->view($this->layout, [
                    "Page" => "reset",
                ]);
                return;
            }
        }
    }
}
?>