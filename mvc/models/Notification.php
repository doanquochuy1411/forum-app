<?php
class Notification extends DB
{
    public function GetUnreadNotificationsByUserId($receiver_id)
    {
        $sql = "select * from notifications where is_read = 0 and receiver_id = ?";
        $result = $this->executeSelectQuery($sql, [$receiver_id]);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
    }

    public function CreateReportNotification($message, $report_id, $post_id)
    {
        // $sql = "INSERT INTO notifications(receiver_id, message, comment_id, report_id) values (?,?,?,?)";
        // Sử dụng subquery để lấy receiver_id (tác giả của bài viết)
        $sql = "INSERT INTO notifications (receiver_id, message, post_id, report_id)
                VALUES (
                    (SELECT user_id FROM posts WHERE id = ?), ?, ?, ?
                )";
        $result = $this->executeQuery($sql, [$post_id, $message, $post_id, $report_id]);

        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }

    public function CreateReportNotificationToAdmin($message, $report_id, $post_id)
    {
        // Sử dụng subquery để lấy receiver_id (tác giả của bài viết)
        $sql = "INSERT INTO notifications (receiver_id, message, post_id, report_id)
            SELECT user_id, ?, ?, ?
            FROM user u
            join user_role ur on ur.user_id = u.id 
            Where u.deleted_at is null and ur.role_id = 1";
        $result = $this->executeQuery($sql, [$message, $post_id, $report_id]);

        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }

    public function GetNotificationByID($id)
    {
        $sql = "select * from notifications where id = ?";
        $result = $this->executeSelectQuery($sql, [$id]);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $data;
    }

    public function UpdateIsRead($notification_id)
    {
        $sql = "update notifications set is_read = ? where id = ?";
        $result = $this->executeQuery($sql, ["1", $notification_id]);
        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }
}