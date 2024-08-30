<?php
class Home extends Controller
{
    protected $UserModel;
    protected $PostModel;
    protected $CommentModel;
    protected $CategoryModel;
    protected $TagModel;
    private $userID;

    public $layout = "client_layout";
    public $page = "home";
    public $title = "Trang chủ";

    public function __construct()
    {
        $this->userID = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : "";
        $this->UserModel = $this->model("User");
        $this->PostModel = $this->model("Post");
        $this->CommentModel = $this->model("Comment");
        $this->CategoryModel = $this->model("Category");
        $this->TagModel = $this->model("Tag");
    }
    function Index()
    {
        $post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10);
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10);
        $comment_db = $this->CommentModel->GetAllComment();
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');
        $category_db = $this->CategoryModel->GetAllCategory();
        $my_post_db = $this->PostModel->GetAllPostWithTypeAndUserID("post", $this->userID); // Lấy bài viết của tôi

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $my_posts = mysqli_fetch_all($my_post_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "posts" => $posts,
            "questions" => $questions,
            "comments" => $comments,
            "users" => $users,
            "categories" => $categories,
            "my_posts" => $my_posts
        ]);
    }
    function Posts($id)
    {
        $relate_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 4);
        $post_db = $this->PostModel->GetPostByID($id);
        $comment_db = $this->CommentModel->GetAllCommentOfPost($id);
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');
        $this->PostModel->IncrementView(1, $id); // Tăng view lên 1

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

    function CreatePost()
    {
        // Chưa login sẽ về trang đăng nhập
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (isset($_REQUEST["btnCreatePost"])) {
            $type = $_REQUEST["contentType"];
            $category_id = $_REQUEST["contentCategory"];
            $title = $_REQUEST["title"];
            $tags = isset($_REQUEST["tags"]) ? $_REQUEST["tags"] : [];
            $content = $_REQUEST["content"];
            $user_id = $_SESSION["UserID"];
            $errors = validateForm(["contentType", "contentCategory", "title"]);
            if (!empty($errors)) {
                $_SESSION['action_status'] = 'fail';
                $_SESSION['title_message'] = "Đăng bài thất bại";
                $_SESSION['message'] = "Tiêu đề không hợp lệ!";
                // $errorMessage = implode(", ", $errors);
                // echo "<script>alert('Error: " . implode(", ", $errorMessage) . "'); history.back();</script>";
                return;
            }

            $post_id = $this->PostModel->CreatePost($title, $content, $user_id, $category_id, $type);

            if ($post_id != 0) { // success

                $allTagsInserted = true; // Flag to check if all tags were inserted correctly

                if (count($tags) > 0) {
                    foreach ($tags as $tag) {
                        $tag_id = $this->TagModel->GetTagByName($tag); // Use CheckTagByName to get ID or false
                        if ($tag_id === false) {
                            $tag_id = $this->TagModel->CreateTag($tag); // // Pass $tag to CreateTag to insert new tag
                        }

                        $result = $this->TagModel->AddTag($post_id, $tag_id);
                        if ($result === false) {

                            $allTagsInserted = false; // Set flag to false if insertion fails
                        }
                    }
                }

                if ($allTagsInserted) {
                    $_SESSION['action_status'] = 'success';
                    $_SESSION['title_message'] = "Đăng bài thành công";
                    // echo "<script>alert('Đăng bài thành công'); setTimeout(function() { window.location.href = '" . BASE_URL . "/home'; }, 3000);</script>";
                } else {
                    $_SESSION['action_status'] = 'fail';
                    $_SESSION['title_message'] = "Đăng bài thành công";
                    $_SESSION['message'] = "Đăng bài thành công nhưng một số tags không được chèn!";
                    // echo "<script>alert('Đăng bài thành công nhưng một số tags không được chèn'); setTimeout(function() { window.location.href = '" . BASE_URL . "/home'; }, 3000);</script>";
                }
            } else {
                $_SESSION['action_status'] = 'fail';
                $_SESSION['title_message'] = "Đăng bài thất bại";
                $_SESSION['message'] = "";
                // echo "<script>alert('Đăng bài thất bại'); setTimeout(function() { window.location.href = '" . BASE_URL . "/home'; }, 3000);</script>";
            }
            header("Location: " . BASE_URL);
            exit();
        }
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