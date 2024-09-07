<?php
// Thao tác với bài viết như sửa, xóa
class Users extends Controller
{
    protected $UserModel;
    // protected $CommentModel;

    private $userID;

    public function __construct()
    {
        if (!isset($_SESSION['UserID'])) {
            header("Location: " . BASE_URL . "/errors/unauthorized");
            exit();
        }

        $this->userID = $_SESSION["UserID"];
        $this->UserModel = $this->model("User");
    }

    function Index()
    {
        header("Location: " . BASE_URL . "");
        exit();
    }

    // function UpdateInfo()
    // {
    //     // Chưa login sẽ về trang đăng nhập
    //     if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
    //         header("Location: " . BASE_URL . "/errors/unauthorized");
    //         exit();
    //     }

    //     if (isset($_REQUEST["btnUpdateInfo"])) {
    //         $user_name = $_REQUEST["user_name"];
    //         $email = $_REQUEST["email"];
    //         $phone_number = $_REQUEST["phone_number"];
    //         $file = $_FILES["user_image"];

    //         if ($file['error'] !== UPLOAD_ERR_OK) {
    //             return "Lỗi khi tải lên hình ảnh.";
    //         } else {
    //             $errors = validateForm(["user_name", "email", "phone_number"]);
    //             if (!empty($errors)) {
    //                 $_SESSION['action_status'] = 'error';
    //                 $_SESSION['title_message'] = "Cập nhật thất bại";
    //                 $_SESSION['message'] = "Dữ liệu không hợp lệ!";
    //                 echo "<script>history.back();</script>";
    //                 return;
    //             }
    //         }



    //         $post_id = $this->CommentModel->CreateComment($content, $this->userID, $post_id, $parent_comment_id);
    //         if ($post_id == 0) {
    //             $_SESSION['action_status'] = 'error';
    //             $_SESSION['title_message'] = "Bình luận thất bại";
    //             $_SESSION['message'] = "Không thể tạo bình luận!";
    //         } else {
    //             $_SESSION['action_status'] = 'success';
    //             $_SESSION['title_message'] = "Bình luận thành công";
    //         }
    //         echo "<script>history.back();</script>";
    //         exit();
    //     }
    // }
}