<?php
class Cart extends Controller
{
    protected $UserModel;

    public $layout = "admin_layout";
    public $page = "admin";
    public $title = "Admin";

    public function __construct()
    {
        $this->UserModel = $this->model("User");
    }

    function Index()
    {
        $userID = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : "";

        $user_db = $this->UserModel->GetUserByID($userID);

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "user" => $user,
        ]);
    }
}

?>