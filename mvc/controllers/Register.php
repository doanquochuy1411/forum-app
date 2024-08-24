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
            $email = $_POST["email"];

            if (!validateEmail($email)) {
                echo "<script>alert('Email không hợp lệ!'); history.back();</script>";
                return;
            }

            $userAccount = $this->UserModel->GetUserByEmail($email);
            if ($userAccount) {
                echo "<script>alert('Email đã được đăng ký!'); history.back();</script>";
                return;
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
            $email = $_POST["email"];
            $code = $_POST["code"];

            if (!verifyCode($code)) {
                echo "<script>alert('Mã xác minh không chính xác!');</script>";
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
            $account_name = $_POST["account_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $retypePassword = $_POST["retype_password"];

            $errors = validateForm(["full_name", "account_name", "password"]);
            if (!empty($errors)) {
                echo "<script>alert('Error: " . implode(", ", $errors) . "');</script>";
                $this->view($this->layout, [
                    "Page" => "register",
                    "title" => $this->title,
                    "data" => $email
                ]);
                return;
            }


            if ($password != $retypePassword) {
                echo "<script>alert('Password and retype password do not matching');</script>";
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
                $this->response($this->layout, "login", $this->title, [$email, $password]);
            } else {
                echo "<script>alert('Fail to register');</script>";
                $this->view($this->layout, [
                    "Page" => "register",
                ]);
                return;
            }
        }
    }
}
?>