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
        $tag_db = $this->TagModel->GetPopularTags();
        $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10);


        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $my_posts = mysqli_fetch_all($my_post_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);
        $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);


        $this->view($this->layout, [
            "Page" => $this->page,
            "title" => $this->title,
            "posts" => $posts,
            "questions" => $questions,
            "comments" => $comments,
            "users" => $users,
            "categories" => $categories,
            "my_posts" => $my_posts,
            "tags" => $tags,
            "recent_posts" => $recent_posts,
        ]);
    }
    // Get post details
    function Posts($id)
    {
        $id = htmlspecialchars($id);
        $relate_post_db = $this->PostModel->GetRelatePosts($id, 10);
        $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10);
        $post_db = $this->PostModel->GetPostByID($id);
        $comment_db = $this->CommentModel->GetAllCommentOfPost($id);
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');
        $this->PostModel->IncrementView(1, $id); // Tăng view lên 1
        $category_db = $this->CategoryModel->GetAllCategory();
        $tag_db = $this->TagModel->GetPopularTags();
        $tag_of_post_db = $this->TagModel->GetTagsOfPost($id); // Lấy tag của bài post
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10);


        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $relate_posts = mysqli_fetch_all($relate_post_db, MYSQLI_ASSOC);
        $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $tags_of_post = mysqli_fetch_all($tag_of_post_db, MYSQLI_ASSOC);


        $this->view($this->layout, [
            "Page" => "post_details",
            "title" => $this->title,
            "posts" => $posts,
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
    // Create
    function CreatePost()
    {
        // Chưa login sẽ về trang đăng nhập
        if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if (isset($_REQUEST["btnCreatePost"])) {
            $type = htmlspecialchars($_REQUEST["contentType"]);
            $category_id = htmlspecialchars($_REQUEST["contentCategory"]);
            $title = htmlspecialchars($_REQUEST["title"]);
            $tags = isset($_REQUEST["tags"]) ? htmlspecialchars($_REQUEST["tags"]) : [];
            $content = htmlspecialchars($_REQUEST["content"]);
            $user_id = $_SESSION["UserID"];
            $errors = validateForm(["contentType", "contentCategory", "title"]);
            if (!empty($errors)) {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Đăng bài thất bại";
                $_SESSION['message'] = "Tiêu đề không hợp lệ!";
                // $errorMessage = implode(", ", $errors);
                echo "<script>history.back();</script>";
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
                } else {
                    $_SESSION['action_status'] = 'error';
                    $_SESSION['title_message'] = "Đăng bài thành công";
                    $_SESSION['message'] = "Đăng bài thành công nhưng một số tags không được chèn!";
                }
            } else {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Đăng bài thất bại";
                $_SESSION['message'] = "";
            }
            echo "<script>history.back();</script>";
            exit();
        }
    }
    // Get question details
    // function Questions($id)
    // {
    //     $relate_post_db = $this->PostModel->GetPostWithTypeAndLimit("question", 4);
    //     $post_db = $this->PostModel->GetPostByID($id);
    //     $comment_db = $this->CommentModel->GetAllCommentOfPost($id);
    //     $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point');

    //     $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
    //     $comments = mysqli_fetch_all($comment_db, MYSQLI_ASSOC);
    //     $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
    //     $relate_post = mysqli_fetch_all($relate_post_db, MYSQLI_ASSOC);

    //     $this->view($this->layout, [
    //         "Page" => "post_details",
    //         "title" => $this->title,
    //         "posts" => $posts,
    //         "recent_post" => $relate_post,
    //         "comments" => $comments,
    //         "users" => $users
    //     ]);
    // }
    // Trang danh mục
    function Categories($category_id, $type)
    {
        if ($type != "post" && $type != "question") {
            $post_db = $this->PostModel->GetAllPostWithCategory($category_id); // body
        } else {
            $post_db = $this->PostModel->GetAllPostWithCategoryAndType($category_id, $type); // body
        }
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10); // footer
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point'); // scroll 
        $category_db = $this->CategoryModel->GetAllCategory(); // header
        $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10); // scroll
        $tag_db = $this->TagModel->GetPopularTags();
        $category_details_db = $this->CategoryModel->GetCategoryByID($category_id); // Lấy thông tin chi tiết của danh mục

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);
        $category_details = mysqli_fetch_all($category_details_db, MYSQLI_ASSOC);

        $sub_title = ""; // Tiêu đề cho đường dẫn
        switch ($type) {
            case "post":
                $sub_title = "bài viết";
                break;
            case "question":
                $sub_title = "câu hỏi";
                break;
            default:
                $sub_title = "";
                break;
        }
        $this->view($this->layout, [
            "Page" => "category",
            "title" => $sub_title,
            "posts" => $posts,
            "questions" => $questions,
            "users" => $users,
            "categories" => $categories,
            "tags" => $tags,
            "recent_posts" => $recent_posts,
            "category_details" => $category_details, // chi tiết danh mục
        ]);
    }
    // Tất cả bài viết || Câu hỏi
    function AllPosts($type)
    {
        $post_db = $this->PostModel->GetAllPostWithType($type); // body
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10); // footer
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point'); // scroll 
        $category_db = $this->CategoryModel->GetAllCategory(); // header
        $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10); // scroll
        $tag_db = $this->TagModel->GetPopularTags();

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);

        $sub_title = ""; // Tiêu đề cho đường dẫn
        switch ($type) {
            case "post":
                $sub_title = "bài viết";
                break;
            case "question":
                $sub_title = "câu hỏi";
                break;
            default:
                $sub_title = "";
                break;
        }
        $this->view($this->layout, [
            "Page" => "category",
            "title" => $sub_title,
            "posts" => $posts,
            "questions" => $questions,
            "users" => $users,
            "categories" => $categories,
            "tags" => $tags,
            "recent_posts" => $recent_posts,
        ]);
    }
    // Trang xử lý sau khi tìm kiếm dựa trên tag, nội dung và tiêu đề
    function Search()
    {

        if (isset($_REQUEST["btnSearch"]) && $_REQUEST["txtSearch"] != "") {
            // echo '<script>alert("' . $_REQUEST["txtSearch"] . '")</script>';
            $txtSearch = sanitizeInput($_REQUEST["txtSearch"]); // làm sạch chuỗi
            $post_db = $this->PostModel->GetPostBySearch($txtSearch); // body

            $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);

            if (count($posts) > 0) { // success
                // $post_db = $this->PostModel->GetPostBySearch($txt); // body
                $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10); // footer
                $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point'); // scroll 
                $category_db = $this->CategoryModel->GetAllCategory(); // header
                $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10); // scroll
                $tag_db = $this->TagModel->GetPopularTags();

                // $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
                $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
                $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
                $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
                $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
                $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);

                $this->view($this->layout, [
                    "Page" => "search",
                    "search" => $txtSearch, // từ khóa cần tìm kiếm
                    "posts" => $posts,
                    "questions" => $questions,
                    "users" => $users,
                    "categories" => $categories,
                    "tags" => $tags,
                    "recent_posts" => $recent_posts,
                ]);
            } else {
                $_SESSION['action_status'] = 'error';
                $_SESSION['title_message'] = "Không tìm thấy bài viết phù hợp!";
                header("Location: " . BASE_URL . "/home/allPosts/post");
                exit();
            }

        } else {
            // header("Location: " . BASE_URL . "");
            // exit();
        }
    }

    function tags($tag)
    {
        $post_db = $this->PostModel->GetPostByTag($tag); // body
        $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10); // footer
        $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point'); // scroll 
        $category_db = $this->CategoryModel->GetAllCategory(); // header
        $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10); // scroll
        $tag_db = $this->TagModel->GetPopularTags();

        $posts = mysqli_fetch_all($post_db, MYSQLI_ASSOC);
        $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
        $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
        $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
        $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);
        $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);

        $this->view($this->layout, [
            "Page" => "search",
            "search" => $tag, // từ khóa cần tìm kiếm
            "posts" => $posts,
            "questions" => $questions,
            "users" => $users,
            "categories" => $categories,
            "tags" => $tags,
            "recent_posts" => $recent_posts,
        ]);
    }
    // Thông tin chi tiết của user
    function Info($account_name)
    {
        $decryptedData = decryptData($account_name); // giải mã account_name để nhận lại tên tài khoản
        $user_details = $this->UserModel->GetUserByAccountName($decryptedData); // body
        // echo "key" . $_SESSION['Key'] . "<br>";
        // echo '<script>alert("' . $decryptedData . '")</script>';
        // print_r($user_details);
        if ($user_details) { // success
            $question_db = $this->PostModel->GetPostWithTypeAndLimit("question", 10); // footer
            $user_db = $this->UserModel->GetAllUserDescWithOrderBy('point'); // scroll 
            $category_db = $this->CategoryModel->GetAllCategory(); // header
            $recent_post_db = $this->PostModel->GetPostWithTypeAndLimit("post", 10); // scroll
            $tag_db = $this->TagModel->GetPopularTags(); // scroll

            $questions = mysqli_fetch_all($question_db, MYSQLI_ASSOC);
            $users = mysqli_fetch_all($user_db, MYSQLI_ASSOC);
            $categories = mysqli_fetch_all($category_db, MYSQLI_ASSOC);
            $recent_posts = mysqli_fetch_all($recent_post_db, MYSQLI_ASSOC);
            $tags = mysqli_fetch_all($tag_db, MYSQLI_ASSOC);

            $this->view($this->layout, [
                "Page" => "user_details",
                "questions" => $questions,
                "users" => $users,
                "categories" => $categories,
                "tags" => $tags,
                "recent_posts" => $recent_posts,
                "user_details" => $user_details
            ]);
        } else {
            $_SESSION['action_status'] = 'error';
            $_SESSION['title_message'] = "Hệ thống gặp sự cố!";
            $_SESSION['message'] = "Chân thành xin lỗi vì sự bất tiện này";
            header("Location: " . BASE_URL . "/home");
            exit();
        }
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