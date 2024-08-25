<?php
class Comment extends DB
{
    public function GetAllComment()
    {
        $sql = "SELECT p.views, c.*, u.user_name AS comment_user_name, u.image AS comment_user_image, p.title AS post_title, p.user_id AS post_owner_id, owner_user.user_name AS owner_name, owner_user.image AS owner_image, pcc.comment_count 
        FROM comments c
        LEFT JOIN
            user u ON u.id = c.user_id
        LEFT JOIN
            posts p ON p.id = c.post_id
        LEFT JOIN
            user owner_user ON owner_user.id = p.user_id -- Để lấy thông tin của người sở hữu bài viết
        LEFT JOIN post_comment_counts pcc on pcc.post_id = c.post_id
        ORDER BY
            p.created_at DESC;
        ";
        return $this->executeSelectQuery($sql);
    }
}