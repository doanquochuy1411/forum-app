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
        if (isset($_POST["g-recaptcha-response"])) {
            $capcha = $_POST["g-recaptcha-response"];
            $result = $this->verifyCapCha($capcha);
            // echo '<script>alert("hihi")</script>';
            if (!$result['success']) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Xác minh thất bại!";
                header("Location: " . BASE_URL . "/login");
                exit();
            }
        }

        if (isset($_POST["btnLogin"])) {
            $user_name = $_POST["user_name"];
            $password = $_POST["password"];

            $errors = validateForm(["user_name", "password"]);
            if (!empty($errors)) {
                // echo "<script>alert('Đăng nhập thất bại !');</script>";
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Đăng nhập thất bại";
                $_SESSION['message'] = "Dữ liệu không hợp lệ!";
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }
            $userAccount = $this->UserModel->GetUserByAccountName($user_name);
            if ($userAccount && $userAccount['locked'] == 1) {
                // echo "<script> alert('Tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu')</script>";
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Tài khoản đã bị khoá";
                $_SESSION['message'] = "Tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu!";
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }
            // echo "<script>alert('name: " . $userAccount . "')</script>";

            if ($userAccount && password_verify($password, $userAccount['password'])) {
                $this->UserModel->ResetLoginAttempts($user_name);
                $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
                $_SESSION['UserID'] = $userAccount["id"];
                $_SESSION['UserName'] = $userAccount["user_name"]; // Hiển thị trên tên trên trang chủ
                $_SESSION['AccountName'] = encryptData($userAccount["account_name"]); // Tên tài khoản của user
                $_SESSION['RoleID'] = $userAccount["role_id"];
                $_SESSION['action_status'] = "none"; // Để nhận biết request thành công hay thất bại. (none / success / error)
                $_SESSION['title_message'] = ""; // Tiêu đề lỗi hoặc thành công
                $_SESSION['message'] = ""; // Thông báo chi tiết lỗi hoặc thành công
                if ($userAccount["role_id"] == 1) {
                    header("Location: " . BASE_URL . "/admin");
                } else {
                    header("Location: " . BASE_URL);
                }
                exit();
            } else {
                if ($userAccount) {
                    $this->UserModel->UpdateLoginAttempts($user_name);
                    $_SESSION['action_status'] = 'error';
                    $_SESSION['title_message'] = "Sai mật khẩu";
                    $_SESSION['message'] = "Bạn còn " . 5 - $userAccount['login_attempts'] - 1 . " đăng nhập!";
                    // echo "<script>alert('Sai mật khẩu lần " . $userAccount['login_attempts'] + 1 . " (Tối đa 5 lần)');</script>";
                    if ($userAccount['login_attempts'] >= 5) {
                        $this->UserModel->UpdateLocked($user_name);
                        $_SESSION['action_status'] = 'error';
                        $_SESSION['title_message'] = "Tài khoản đã bị khóa";
                        $_SESSION['message'] = "Bạn đã đăng nhập sai quá 5 lần, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu!";
                        // echo "<script> alert('Bạn đã đăng nhập sai quá 5 lần, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu')</script>";
                    }
                } else {
                    // echo "<script>alert('Tài khoản không chính xác!');</script>";
                    $_SESSION['action_status'] = 'error';
                    $_SESSION['title_message'] = "Tên tài khoản không chính xác";
                    // $_SESSION['message'] = "Bạn đã đăng nhập sai quá 5 lần, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu!";
                }
                $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }
        }
    }
    function verifyCapCha($response)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $_SESSION["SECRET_KEY"],
            'response' => $response,
            // 'remoteip' => $_SERVER['REMOTE_ADDR'] // nếu bạn cần xác định IP client
        ];

        // Khởi tạo cURL
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $res = curl_exec($ch);

        // Kiểm tra lỗi cURL
        if (curl_errno($ch)) {
            echo 'Lỗi cURL: ' . curl_error($ch);
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return json_decode($res, true);
    }

}
?>