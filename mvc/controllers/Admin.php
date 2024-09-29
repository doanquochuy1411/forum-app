<?php
class Admin extends Controller
{
    protected $UserModel;
    protected $PostModel;
    protected $CommentModel;
    protected $CategoryModel;

    private $userID;

    public $layout = "admin_layout";
    public $page = "dashboard";
    public $title = "Admin";


    public function __construct()
    {
        if (!isset($_SESSION['RoleID']) || $_SESSION['RoleID'] != 1) {
            header("Location: " . BASE_URL);
            exit();
        }
        $this->userID = $_SESSION["UserID"];
        $this->UserModel = $this->model("User");
        $this->PostModel = $this->model("Post");
        $this->CommentModel = $this->model("Comment");
        $this->CategoryModel = $this->model("Category");
    }

    function Index()
    {
        $user = $this->UserModel->GetUserByID($this->userID); // get user details
        $all_users = $this->UserModel->GetAllUserDescWithOrderBy("created_at"); // get all user
        $posts = $this->PostModel->GetAllPostWithType("post"); // get all post
        $questions = $this->PostModel->GetAllPostWithType("question"); // get all question
        $comments = $this->CommentModel->GetAllComment(); // get all comment

        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "user" => $user,
            "all_users" => $all_users,
            "posts" => $posts,
            "questions" => $questions,
            "comments" => $comments,
        ]);
    }

    function Users()
    {
        $user = $this->UserModel->GetUserByID($this->userID); // get user details
        $all_users = $this->UserModel->GetAllUserDescWithOrderBy("created_at"); // get all user
        $this->view($this->layout, [
            "Page" => 'user',
            "title" => $this->title,
            "user" => $user,
            "all_users" => $all_users,
        ]);
    }

    function Posts()
    {
        $users = $this->UserModel->GetUserByID($this->userID); // get user details
        $posts = $this->PostModel->GetAllPostWithType("post"); // get all post

        $this->view($this->layout, [
            "Page" => 'post',
            "title" => $this->title,
            "user" => $users,
            "posts" => $posts,
        ]);
    }

    function Questions()
    {
        $user = $this->UserModel->GetUserByID($this->userID); // get user details
        $questions = $this->PostModel->GetAllPostWithType("question"); // get all questions

        $this->view($this->layout, [
            "Page" => 'question',
            "title" => $this->title,
            "user" => $user,
            "questions" => $questions,
        ]);

    }
    function Categories()
    {
        $user = $this->UserModel->GetUserByID($this->userID); // get user details
        $categories = $this->CategoryModel->GetAllCategory(); // get all category

        $this->view($this->layout, [
            "Page" => 'category_admin',
            "title" => $this->title,
            "user" => $user,
            "categories" => $categories,
        ]);
    }

    function AddUser()
    {
        // Kiểm tra token
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/errors/unauthorized");
            exit();
        }

        if (isset($_REQUEST["btnAddUser"])) {
            $full_name = htmlspecialchars($_POST["full_name"]);
            $account_name = htmlspecialchars(strtolower(trim($_POST["account_name"])));
            $email = strtolower(trim($_POST["email"]));
            $password = $_POST["password"];

            $errors = validateForm(["full_name", "account_name", "email", "password"]);
            if (!empty($errors)) {
                $title = 'Thêm thành viên thất bại!';
                $message = 'Thông tin thành viên không hợp lệ: ' . implode(", ", $errors);
                response_error($title, $message);
                $this->view($this->layout, [
                    "Page" => "admin",
                    "title" => $this->title,
                ]);
                return;
            }

            $userAccount = $this->UserModel->GetUserByEmail($email);
            if ($userAccount) {
                $title = 'Thêm thành viên thất bại!';
                $message = 'Email đã được sử dụng!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
            }

            $userAccount = $this->UserModel->CheckAccountName($account_name);
            if ($userAccount) {
                $title = 'Thêm thành viên thất bại!';
                $message = 'Tên tài khoản đã được sử dụng!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $result = $this->UserModel->CreateUser($account_name, $full_name, $email, $hashedPassword);
            if ($result) {
                $userAccount = $this->UserModel->GetUserByEmail($email);
                $this->UserModel->SetRole($userAccount["id"], "2");
                // 1: admin
                // 2: customer
                $title = 'Thêm thành viên thành công!';
                $message = '';
                response_success($title, $message);
                echo "<script>history.back();</script>";
                exit();
            } else {
                // echo "<script>alert('Fail to register');</script>";
                $title = 'Thêm thành viên thất bại!';
                $message = 'Lỗi hệ thống!';
                response_error($title, $message);
                echo "<script>history.back();</script>";
                exit();
            }
        }
    }

    function DeleteCategory($id, $token)
    {
        // Xác minh token
        if ($token == "" || $token != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/errors/unauthorized");
            exit();
        }

        $result = $this->CategoryModel->DeleteCategoryByID($id);
        if ($result == 0) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Xóa thất bại";
            $_SESSION['message'] = "Lỗi hệ thống!";
        } else {

        }
        if ($result == 1) {
            $_SESSION['action_status'] = 'success';
            $_SESSION['title_message'] = "Xóa thành công";
        } else {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Xóa thất bại";
            $_SESSION['message'] = "Không thể xóa. $result bài viết thuộc danh mục này!";
        }
        echo "<script>history.back();</script>";
        exit();
    }

    function AddCategory()
    {
        // Kiểm tra token
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/errors/unauthorized");
            exit();
        }

        if (isset($_REQUEST["btnAddCategory"])) {
            $category_name = htmlspecialchars($_POST["category_name"]);
            $category_description = htmlspecialchars($_POST["category_description"]);

            $errors = validateForm(["category_name", "category_description"]);
            if (!empty($errors)) {
                $title = 'Thêm danh mục thất bại!';
                $message = 'Thông tin danh mục không hợp lệ: ' . implode(", ", $errors);
                response_error($title, $message);
                $this->view($this->layout, [
                    "Page" => "admin",
                    "title" => $this->title,
                ]);
                return;
            }
            $result = $this->CategoryModel->CreateCategory($category_name, $category_description);
            if ($result) {
                $title = 'Thêm danh mục thành công';
                response_success($title);
            } else {
                $title = 'Thêm danh mục thất bại';
                $mes = "Lỗi hệ thống!";
                response_error($title, $mes);
            }
            echo "<script>history.back();</script>";
            exit();
        } else {
            header("Location: " . BASE_URL . "/errors/unauthorized");
        }
    }

}

?>