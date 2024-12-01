<?php
class Login extends Controller
{
    public $UserModel;
    protected $CategoryModel;
    public $layout = "client_layout";
    public $page = "login";
    public $title = "Đăng nhập";

    public function __construct()
    {
        if (isset($_SESSION['UserID'])) {
            header("Location: " . BASE_URL);
            exit();
        }
        $this->UserModel = $this->model("User");
        $this->CategoryModel = $this->model("Category");
    }

    function Index()
    {
        $categories = $this->CategoryModel->GetAllCategory();


        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "categories" => $categories,
        ]);
    }

    function HandelLogin()
    {
        $categories = $this->CategoryModel->GetAllCategory();
        if (isset($_POST["g-recaptcha-response"])) {
            $capcha = $_POST["g-recaptcha-response"];
            $result = $this->verifyCapCha($capcha);
            // echo '<script>alert("hihi")</script>';
            if (!$result['success']) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Xác minh thất bại!";
                $_SESSION['message'] = "Vui lòng xác thực mã capcha bên dưới!";
                header("Location: " . BASE_URL . "/login");
                exit();
            }
        }

        if (isset($_POST["btnLogin"])) {
            $user_name = htmlspecialchars($_POST["user_name"]);
            $password = htmlspecialchars($_POST["password"]);

            $errors = validateForm(["user_name", "password"]);
            if (!empty($errors)) {
                // echo "<script>alert('Đăng nhập thất bại !');</script>";
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Đăng nhập thất bại";
                $_SESSION['message'] = "Dữ liệu không hợp lệ!";
                $this->view($this->layout, [
                    "Page" => $this->page,
                    "title" => $this->title,
                    "categories" => $categories,
                    "data" => [$user_name, $password]
                ]);
                // $this->response($this->layout, "login", $this->title, [$user_name, $password]);
                return;
            }

            $userAccount = $this->UserModel->GetUserByAccountName(encryptData($user_name));
            if ($userAccount && $userAccount['locked'] == 1) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Tài khoản đã bị khoá";
                $_SESSION['message'] = "Tài khoản của bạn đã bị khóa, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu!";
                $this->view($this->layout, [
                    "Page" => $this->page,
                    "title" => $this->title,
                    "categories" => $categories,
                    "data" => [$user_name, $password]
                ]);
                return;
            }

            if ($userAccount && password_verify($password, $userAccount['password'])) {
                $this->UserModel->ResetLoginAttempts($user_name);
                $_SESSION['action_status'] = "none"; // (none / success / error)
                $_SESSION['title_message'] = "";
                $_SESSION['message'] = "";
                if ($userAccount["role_id"] == 1) {
                    $link = GetQR($userAccount["google_auth_secret"], $user_name);
                    $this->view($this->layout, [
                        "Page" => "authentication_2fa",
                        "title" => $this->title,
                        "categories" => $categories,
                        "account_name" => $userAccount["account_name"],
                        "link" => $link,
                    ]);
                } else {
                    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
                    $_SESSION['UserID'] = $userAccount["id"];
                    $_SESSION['UserName'] = $userAccount["user_name"];
                    $_SESSION['AccountName'] = encryptData($userAccount["account_name"]);
                    $_SESSION['RoleID'] = $userAccount["role_id"];
                    $_SESSION['Avatar'] = $userAccount["image"];
                    header("Location: " . BASE_URL);
                }
                exit();
            } else {
                if ($userAccount) {
                    $this->UserModel->UpdateLoginAttempts($user_name);
                    $_SESSION['action_status'] = 'error';
                    $_SESSION['title_message'] = "Sai mật khẩu";
                    $_SESSION['message'] = "Bạn còn " . 5 - $userAccount['login_attempts'] - 1 . " đăng nhập!";
                    if ($userAccount['login_attempts'] >= 5) {
                        $this->UserModel->UpdateLocked($user_name);
                        $_SESSION['action_status'] = 'error';
                        $_SESSION['title_message'] = "Tài khoản đã bị khóa";
                        $_SESSION['message'] = "Bạn đã đăng nhập sai quá 5 lần, vui lòng liên hệ quản trị viên hoặc sử dụng quên mật khẩu!";
                    }
                } else {
                    $_SESSION['action_status'] = 'error';
                    $_SESSION['title_message'] = "Tên tài khoản không chính xác";
                }
                $this->view($this->layout, [
                    "Page" => $this->page,
                    "title" => $this->title,
                    "categories" => $categories,
                    "data" => [$user_name, $password]
                ]);
                return;
            }
        }
    }

    function Handel2FA()
    {
        if (isset($_POST["btn2FA"])) {
            $passCode = htmlspecialchars($_POST["pass_code"]);
            $account_name = htmlspecialchars($_POST["account_name"]);
            $categories = $this->CategoryModel->GetAllCategory();

            $userAccount = $this->UserModel->GetUserByAccountName(encryptData($account_name));
            if (!VerifyPassCode($passCode, $userAccount["google_auth_secret"])) {
                $title = "Xác minh thất bại!";
                $message = "Mã xác minh không chính xác.";
                response_error($title, $message);

                $link = GetQR($userAccount["google_auth_secret"], $account_name);
                $this->view($this->layout, [
                    "Page" => "authentication_2fa",
                    "title" => $this->title,
                    "categories" => $categories,
                    "account_name" => $userAccount["account_name"],
                    "link" => $link,
                ]);
                exit();
            } else {
                $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
                $_SESSION['UserID'] = $userAccount["id"];
                $_SESSION['UserName'] = $userAccount["user_name"]; // Hiển thị trên tên trên trang chủ
                $_SESSION['AccountName'] = encryptData($userAccount["account_name"]); // Tên tài khoản của user
                $_SESSION['RoleID'] = $userAccount["role_id"];
                $_SESSION['Avatar'] = $userAccount["image"];
                header("Location: " . BASE_URL . "/admin");
            }
        } else {
            header("Location: " . BASE_URL . "/errors/unauthorized");
            exit();
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