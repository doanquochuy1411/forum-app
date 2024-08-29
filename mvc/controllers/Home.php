<?php
class Home extends Controller
{
    protected $UserModel;
    protected $PostModel;
    protected $CommentModel;


    public $layout = "client_layout";
    public $page = "home";
    public $title = "Trang chủ";

    public function __construct()
    {
        $this->UserModel = $this->model("User");
        $this->PostModel = $this->model("Post");
        $this->CommentModel = $this->model("Comment");
    }
    function Index()
    {
        $post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10);
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10);
        $comment_db = $this->CommentModel->GetAllComment();
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "posts" => $posts,
            "questions" => $questions,
            "comments" => $comments,
            "users" => $users
        ]);
    }
    function Posts($id)
    {
        $relate_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 4);
        $post_db = $this->PostModel->GetPostByID($id);
        $comment_db = $this->CommentModel->GetAllCommentOfPost($id);
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $relate_post = mysqli_fetch_all($relate_post_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => "post_details",
            "title" => $this->title,
            "posts" => $posts,
            "relate_posts" => $relate_post,
            "comments" => $comments,
            "users" => $users
        ]);
    }
    function Questions($id)
    {
        $relate_post_db = $this->PostModel->GetPostWithTypeAndLimit("question", 4);
        $post_db = $this->PostModel->GetPostByID($id);
        $comment_db = $this->CommentModel->GetAllCommentOfPost($id);
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $relate_post = mysqli_fetch_all($relate_post_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => "post_details",
            "title" => $this->title,
            "posts" => $posts,
            "relate_posts" => $relate_post,
            "comments" => $comments,
            "users" => $users
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