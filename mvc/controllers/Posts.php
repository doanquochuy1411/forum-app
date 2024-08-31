<?php
class Posts extends Controller
{
    protected $PostModel;
    protected $CommentModel;

    private $userID;

    public function __construct()
    {
        $this->userID = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : "";
        $this->PostModel = $this->model("Post");
        $this->CommentModel = $this->model("Comment");
    }

    function Index()
    {
        header("Location: " . BASE_URL . "");
        exit();
    }

    function CreateComment()
    {
        // Chưa login sẽ về trang đăng nhập
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (isset($_REQUEST["btnComment"])) {
            $content = $_REQUEST["content"];
            $parent_comment_id = $_REQUEST["parent_comment_id"];
            $post_id = $_REQUEST["post_id"];

            $errors = validateForm(["parent_comment_id", "post_id"]);
            if (!empty($errors)) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Bình luận thất bại";
                $_SESSION['message'] = "Dữ liệu không hợp lệ!";
                echo "<script>history.back();</script>";
                return;
            }

            $post_id = $this->CommentModel->CreateComment($content, $this->userID, $post_id, $parent_comment_id);
            if ($post_id == 0) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Bình luận thất bại";
                $_SESSION['message'] = "Không thể tạo bình luận!";
            } else {
                $_SESSION['action_status'] = 'success';
                $_SESSION['title_message'] = "Bình luận thành công";
            }
            echo "<script>history.back();</script>";
            exit();
        }
    }
}