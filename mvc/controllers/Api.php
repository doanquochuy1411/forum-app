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

        // Trả về JSON
        echo json_encode([
            'code' => 200,
            'status' => "success",
            'user_details' => $userDetails
        ]);
    }
}

?>