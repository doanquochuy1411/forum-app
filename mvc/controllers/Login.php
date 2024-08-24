<?php
class Login extends Controller
{
    public $UserModel;

    public $layout = "auth_layout";
    public $page = "login";
    public $title = "Đăng nhập";

    public function __construct()
    {
        $this->UserModel = $this->model("User");
    }

    function Index()
    {
        $this->response($this->layout, $this->page, $this->title, "");
    }

    function HandelLogin()
    {
        if (isset($_POST["btnLogin"])) {
            $user_name = $_POST["user_name"];
            $password = $_POST["password"];
            $errors = validateForm(["user_name", "password"]);
            if (!empty($errors)) {
                echo "<script>alert('Đăng nhập thất bại !');</script>";
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }

            $userAccount = $this->UserModel->GetUserByAccountName($user_name);
            if ($userAccount && $userAccount['locked'] == 1) {
                echo "<script> alert('Tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu')</script>";
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }

            if ($userAccount && password_verify($password, $userAccount['password'])) {
                $this->UserModel->ResetLoginAttempts($user_name);
                $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
                $_SESSION['UserID'] = $userAccount["id"];
                header("Location: " . BASE_URL);
                exit();
            } else {
                if ($userAccount) {
                    $this->UserModel->UpdateLoginAttempts($user_name);
                    echo "<script>alert('Sai mật khẩu lần " . $userAccount['login_attempts'] + 1 . " (Tối đa 5 lần)');</script>";
                    if ($userAccount['login_attempts'] >= 5) {
                        $this->UserModel->UpdateLocked($user_name);
                        echo "<script> alert('Bạn đã đăng nhập sai quá 5 lần, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu')</script>";
                    }
                } else {
                    echo "<script>alert('Tài khoản không chính xác!');</script>";
                }
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }
        }
    }
}
?>