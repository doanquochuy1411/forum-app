<?php
class Reports extends Controller
{
    protected $UserModel;
    protected $PostModel;
    protected $ReportModel;
    protected $NotificationModel;

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
    }
    // Gửi báo cáo
    function Index()
    {
        header("Location: " . BASE_URL);
        exit();
    }

    function Send($post_id)
    {
        if (isset($_POST["btnReport"])) {
            // Kiểm tra token
            if ($_REQUEST["token"] == "" || $_REQUEST["token"] != $_SESSION['_token']) {
                header("Location: " . BASE_URL . "/errors/Unauthorized");
                exit();
            }

            $finalReport = "";
            // Lấy lý do báo cáo từ checkbox
            if (isset($_POST['report_reasons'])) {
                // Escape từng giá trị trong mảng report_reasons
                $reportReasons = array_map('htmlspecialchars', $_POST['report_reasons']);
                // Nối các phần tử mảng thành chuỗi, cách nhau bởi dấu phẩy
                $reportReasonsString = implode(", ", $reportReasons);

                // Lấy thông tin bổ sung và thoát các ký tự đặc biệt để tránh lỗi XSS
                $additionalInfo = htmlspecialchars($_POST['additional_info']);
                $post_id = htmlspecialchars($post_id);

                // Kiểm tra nếu người dùng nhập thông tin bổ sung
                if (!empty($additionalInfo)) {
                    // Nối thông tin bổ sung vào sau chuỗi các lý do
                    $finalReport = $reportReasonsString . ". Thông tin bổ sung: " . $additionalInfo;
                } else {
                    // Nếu không có thông tin bổ sung, chỉ hiển thị các lý do
                    $finalReport = $reportReasonsString;
                }
            }

            // Thực hiện các thao tác cần thiết như lưu vào database, kiểm tra token, hoặc xử lý lý do báo cáo
            if (!empty($finalReport)) {
                $report_id = $this->ReportModel->CreateReport($post_id, $finalReport, $this->userID);
                if ($report_id != 0) {
                    // Thông báo cho tác giả
                    $this->NotificationModel->CreateReportNotification("Bài viết của bạn đã bị báo cáo với lý do: $finalReport", $report_id, $post_id);
                    // Gửi thông báo real-time qua Pusher cho tác giả
                    $this->sendNotification($this->userID, "Bài viết của bạn đã bị báo cáo với lý do: $finalReport", null, $post_id);

                    // Lấy danh sách tất cả các admin
                    $admins_db = $this->UserModel->GetAllAdmin();
                    $admins = mysqli_fetch_all($admins_db, MYSQLI_ASSOC);
                    // Gửi thông báo cho tất cả các admin
                    $this->NotificationModel->CreateReportNotificationToAdmin("Một bài viết đã bị báo cáo với lý do: $finalReport", $report_id, $post_id);
                    foreach ($admins as $admin) {
                        $this->sendNotification($admin['id'], "Một bài viết đã bị báo cáo với lý do: $finalReport", null, $post_id);
                    }

                    $title = 'Báo xấu thành công';
                    response_success($title, "Chúng tôi sẽ tiến hành xử lý. Chân thành cảm ơn sự đóng góp của bạn!");
                } else {
                    $title = 'Báo xấu thất bại';
                    response_error($title, "Rất tiếc. Hệ thống đang gặp sự cố!");
                }
                echo "<script>history.back();</script>";
                return;
            }
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    private function sendNotification($receiver_id, $message, $commentId = null, $postId = null)
    {
        global $pusher;

        $data['message'] = array(
            'receiver_id' => $receiver_id,
            'message' => $message,
            'commentId' => $commentId,
            'postId' => $postId,
        );

        $result = $pusher->trigger('post-reported', 'PostReported', $data);

        // In ra kết quả của Pusher trigger
        if ($result === true) {
            error_log("Notification sent successfully: " . json_encode($data));
        } else {
            error_log("Notification failed: " . json_encode($data));
        }
    }

}
?>