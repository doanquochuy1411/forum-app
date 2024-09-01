<?php
// Thao tác với bài viết như sửa, xóa
class Posts extends Controller
{
    protected $PostModel;
    protected $CommentModel;

    private $userID;

    public function __construct()
    {
        if (!isset($_SESSION['UserID'])) {
            header("Location: " . BASE_URL);
            exit();
        }


        $this->userID = $_SESSION["UserID"];
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

    function DeleteComment($id, $token)
    {
        // Chưa login sẽ về trang đăng nhập
        if ($token == "" || $token != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (!validateID($id)) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Xóa bình luận thất bại";
            $_SESSION['message'] = "Dữ liệu không hợp lệ!";
            echo "<script>history.back();</script>";
            return;
        }
        // // Trả về true nếu xóa thành công và ngược lại
        $result = $this->CommentModel->DeleteComment($id);
        if (!$result) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Xóa bình luận thất bại";
            $_SESSION['message'] = "Truy vấn gặp sự cố!";
        } else {
            $_SESSION['action_status'] = 'success';
            $_SESSION['title_message'] = "Xóa bình luận thành công";
        }
        echo "<script>history.back();</script>";
        exit();
    }
}