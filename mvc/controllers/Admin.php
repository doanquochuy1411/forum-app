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
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $all_user_db = $this->UserModel->GetAllUserDescWithOrderBy("created_at"); // get all user
        $post_db = $this->PostModel->GetAllPostWithType("post"); // get all post
        $question_db = $this->PostModel->GetAllPostWithType("question"); // get all question
        $comment_db = $this->CommentModel->GetAllComment(); // get all comment

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $all_users = mysqli_fetch_all($all_user_db, MYSQLI_ASSOC);
        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);

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
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $all_user_db = $this->UserModel->GetAllUserDescWithOrderBy("created_at"); // get all user

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $all_users = mysqli_fetch_all($all_user_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => 'user',
            "title" => $this->title,
            "user" => $user,
            "all_users" => $all_users,
        ]);
    }
    function UsersClone()
    {
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $all_user_db = $this->UserModel->GetAllUserDescWithOrderBy("created_at"); // get all user

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $all_users = mysqli_fetch_all($all_user_db, MYSQLI_ASSOC);

        $this->view("admin_layout_clone", [
            "Page" => 'user_clone',
            "title" => $this->title,
            "user" => $user,
            "all_users" => $all_users,
        ]);
    }

    function Posts()
    {
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $post_db = $this->PostModel->GetAllPostWithType("post"); // get all post

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => 'post',
            "title" => $this->title,
            "user" => $user,
            "posts" => $posts,
        ]);
    }

    function Questions()
    {
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $questions_db = $this->PostModel->GetAllPostWithType("question"); // get all questions

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($questions_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => 'question',
            "title" => $this->title,
            "user" => $user,
            "questions" => $questions,
        ]);

    }
    function Categories()
    {
        $user_db = $this->UserModel->GetUserByID($this->userID); // get user details
        $categories_db = $this->CategoryModel->GetAllCategory(); // get all category

        $user = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($categories_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => 'category',
            "title" => $this->title,
            "user" => $user,
            "categories" => $categories,
        ]);
    }
}

?>