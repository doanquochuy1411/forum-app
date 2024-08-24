<?php
class Home extends Controller
{
    public $UserModel;


    public $layout = "client_layout";
    public $page = "home";
    public $title = "Trang chủ";

    public function __construct()
    {
        $this->UserModel = $this->model("User");
    }
    function Index()
    {
        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
        ]);
    }

    function Logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: " . BASE_URL);
        exit();
    }
}
?>