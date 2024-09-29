<?php
// Thao tác với bài viết như sửa, xóa
class Posts extends Controller
{
    protected $PostModel;
    protected $CommentModel;
    protected $UserModel;
    protected $CategoryModel;
    protected $TagModel;
    private $userID;

    public $layout = "client_layout";

    public $title = "Bài viết";

    public function __construct()
    {
        if (!isset($_SESSION['UserID'])) {
            header("Location: " . BASE_URL);
            exit();
        }

        $this->userID = $_SESSION["UserID"];
        $this->PostModel = $this->model("Post");
        $this->UserModel = $this->model("User");
        $this->CommentModel = $this->model("Comment");
        $this->CategoryModel = $this->model("Category");
        $this->TagModel = $this->model("Tag");
    }

    function Index()
    {
        header("Location: " . BASE_URL . "");
        exit();
    }

    function CreateComment()
    {
        // Kiểm tra token
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (isset($_REQUEST["btnComment"])) {
            $content = htmlspecialchars($_REQUEST["content"]);
            $parent_comment_id = htmlspecialchars($_REQUEST["parent_comment_id"]);
            $post_id = htmlspecialchars($_REQUEST["post_id"]);

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
        $id = htmlspecialchars($id);
        // Chưa login sẽ về trang đăng nhập
        if ($token == "" || $token != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $comment = $this->CommentModel->GetCommentByID($id);

        if ($comment[0]['user_id'] != $_SESSION['UserID']) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Không có quyền truy cập!";
            header("Location: " . BASE_URL);
            exit();
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
    // To view edit
    function Edit($id)
    {
        $id = htmlspecialchars($id);
        $posts = $this->PostModel->GetPostByID($id);

        if ($posts[0]['user_id'] != $_SESSION['UserID']) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Không có quyền truy cập!";
            header("Location: " . BASE_URL);
            exit();
        }

        $relate_posts = $this->PostModel->GetRelatePosts($id, 10);
        $recent_posts = $this->PostModel->GetPostWithTypeAndLimit("post", 10);
        $comments = $this->CommentModel->GetAllCommentOfPost($id);
        $users = $this->UserModel->GetAllUserDescWithOrderBy('point');
        $this->PostModel->IncrementView(1, $id); // Tăng view lên 1
        $categories = $this->CategoryModel->GetAllCategory();
        $tags = $this->TagModel->GetPopularTags();
        $tags_of_post = $this->TagModel->GetTagsOfPost($id); // Lấy tag của bài post
        $questions = $this->PostModel->GetPostWithTypeAndLimit("question", 10);

        $this->view($this->layout, [
            "Page" => "edit_post",
            "title" => $this->title,
            "post_to_edit" => $posts, // Post details
            "relate_posts" => $relate_posts,
            "recent_posts" => $recent_posts,
            "comments" => $comments,
            "users" => $users,
            "categories" => $categories,
            "tags" => $tags,
            "questions" => $questions,
            "tags_of_post" => $tags_of_post,
        ]);
    }

    function HandleEdit($id)
    {
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (isset($_REQUEST["btnEditPost"])) {
            $type = htmlspecialchars($_REQUEST["contentType"]);
            $category_id = htmlspecialchars($_REQUEST["contentCategory"]);
            $title = htmlspecialchars($_REQUEST["title"]);
            $tags = isset($_REQUEST["tags"]) ? htmlspecialchars($_REQUEST["tags"]) : [];
            $content = htmlspecialchars($_REQUEST["content"]);
            $errors = validateForm(["contentType", "contentCategory", "title"]);
            if (!empty($errors)) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Cập nhật thất bại";
                $_SESSION['message'] = "Dữ liệu không hợp lệ!";
                echo "<script>history.back();</script>";
                return;
            }

            $result = $this->PostModel->UpdatePost($id, $title, $content, $category_id, $type);

            // if ($result != 0) { // success
            $allTagsInserted = true; // Flag to check if all tags were inserted correctly

            $tag_delete_result = $this->TagModel->DeleteTagOfPost($id);
            if ($tag_delete_result == 0) { // fail
                $allTagsInserted = false; // Set flag to false if insertion fails

            }

            if (count($tags) > 0) {
                foreach ($tags as $tag) {
                    $tag_id = $this->TagModel->GetTagByName($tag); // Use CheckTagByName to get ID or false
                    if ($tag_id === false) {
                        $tag_id = $this->TagModel->CreateTag($tag); // // Pass $tag to CreateTag to insert new tag
                    }

                    $result = $this->TagModel->AddTag($id, $tag_id);
                    if ($result === false) {

                        $allTagsInserted = false; // Set flag to false if insertion fails
                    }
                }
            }

            if ($allTagsInserted) {
                $_SESSION['action_status'] = 'success';
                $_SESSION['title_message'] = "Cập nhật thành công";
            } else {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Cập nhật thành công";
                $_SESSION['message'] = "Cập nhật thành công nhưng một số tags không được cập nhật!";
            }

            echo "<script>history.back();</script>";
            exit();
        }
    }
    // Delete post
    function Delete($id, $token)
    {
        // Xác minh token
        if ($token == "" || $token != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $post = $this->PostModel->GetPostByID($id);

        if ($post[0]['user_id'] != $_SESSION['UserID'] && $_SESSION['RoleID'] != 1) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Không có quyền truy cập!";
            header("Location: " . BASE_URL);
            exit();
        }

        // // Trả về true nếu xóa thành công và ngược lại
        $result = $this->PostModel->DeletePost($id);
        if (!$result) {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Xóa bài viết thất bại";
            $_SESSION['message'] = "Truy vấn gặp sự cố!";
        } else {
            $_SESSION['action_status'] = 'success';
            $_SESSION['title_message'] = "Xóa bài viết thành công";
        }
        echo "<script>history.back();</script>";
        exit();
    }
}