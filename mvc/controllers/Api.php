<?php
class Api extends Controller
{
    protected $UserModel;
    protected $PostModel;
    protected $ReportModel;
    protected $NotificationModel;
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
        $this->UserModel = $this->model("User");
        $this->ReportModel = $this->model("Report");
        $this->NotificationModel = $this->model("Notification");
        $this->CommentModel = $this->model("Comment");
    }
    // Gửi báo cáo
    function Index()
    {
        echo json_encode([
            'code' => "401",
            'status' => "error",
            'message' => "permission denied"
        ]);
    }

    public function getNotifications()
    {
        // Lấy danh sách thông báo từ database
        $notifications = $this->NotificationModel->GetUnreadNotificationsByUserId($this->userID);

        if (empty($notifications)) {
            // Trả về lỗi 400 nếu không tìm thấy dữ liệu
            http_response_code(400); // Đặt mã phản hồi là 400
            echo json_encode([
                'code' => 400,
                'status' => "error",
                'message' => "Không tìm thấy thông báo cho người dùng này.",
            ]);
            return; // Dừng lại nếu dữ liệu trống
        }

        // Trả về JSON
        echo json_encode([
            'code' => 200,
            'status' => "success",
            'count' => count($notifications),
            'notifications' => $notifications
        ]);
    }

    public function getUserDetailsViaCmtID($cmt_id)
    {
        // Lấy danh sách thông báo từ database
        $userDetails = $this->CommentModel->GetAuthOfComment($cmt_id);
        // print_r($userDetails);
        if (empty($userDetails)) {
            // Trả về lỗi 400 nếu không tìm thấy dữ liệu
            http_response_code(400); // Đặt mã phản hồi là 400
            echo json_encode([
                'code' => 400,
                'status' => "error",
                'message' => "Không tìm thấy dữ liệu người dùng cho bình luận này.",
            ]);
            return; // Dừng lại nếu dữ liệu trống
        }

        // Trả về JSON
        echo json_encode([
            'code' => 200,
            'status' => "success",
            'user_details' => $userDetails,
        ]);
    }

    public function getPostToStatistics($year)
    {
        // Lấy danh sách thông báo từ database
        $result = $this->PostModel->GetPostAmountPerMonthByYear($year);
        if (mysqli_num_rows($result) > 0) {
            $posts = array_fill(0, 12, 0);
            while ($row = mysqli_fetch_assoc($result)) {
                $posts[$row['month'] - 1] = $row['post_count'];
            }
            http_response_code(200);
            echo json_encode([
                'code' => 200,
                'status' => "success",
                'posts' => $posts,
                'message' => "Lấy dữ liệu thành công",
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'status' => "error",
                'message' => "Không tìm thấy dữ liệu thống kê.",
            ]);
            return;
        }
    }

    public function getUserToStatistics($year)
    {
        // Lấy danh sách thông báo từ database
        $result = $this->UserModel->GetUserAmountPerMonthByYear($year);
        if (mysqli_num_rows($result) > 0) {
            $userData = array_fill(0, 12, 0);
            while ($row = mysqli_fetch_assoc($result)) {
                $userData[$row['month'] - 1] = $row['user_count'];
            }
            http_response_code(200);
            echo json_encode([
                'code' => 200,
                'status' => "success",
                'users' => $userData,
                'message' => "Lấy dữ liệu thành công",
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'status' => "error",
                'message' => "Không tìm thấy dữ liệu thống kê.",
            ]);
            return;
        }
    }

    public function HandelLikePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId = $_POST['post_id'];
            $userId = $_POST['user_id'];
            $status = "";

            $checkLiked = $this->PostModel->CheckLikedPostByUser($userId, $postId);
            if ($checkLiked) {
                $this->PostModel->CancelLikedPostByUser($userId, $postId);
                $status = 'unliked';
            } else {
                $this->PostModel->CreateLikedPostByUser($userId, $postId);
                $status = 'liked';
            }
        }

        $likeCount = $this->PostModel->CountLikedOfPost($postId);
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'status' => "success",
            'like_status' => $status,
            'like_count' => $likeCount,
            'message' => "Dữ liệu đã được xử lý",
        ]);
    }

    public function CheckLikedPost($postId, $userId)
    {
        $checkLiked = $this->PostModel->CheckLikedPostByUser($userId, $postId);
        if ($checkLiked) {
            http_response_code(200);
            echo json_encode([
                'code' => 200,
                'status' => "success",
                'like_status' => "liked",
                'message' => "Kiểm tra trạng thái thích thành công",
            ]);
        } else {
            http_response_code(200);
            echo json_encode([
                'code' => 200,
                'status' => "success",
                'like_status' => "unliked",
                'message' => "Kiểm tra trạng thái thích thành công",
            ]);
        }
    }
}

?>