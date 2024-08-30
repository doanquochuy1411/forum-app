<?php
class Post extends DB
{
    public function GetAllPostWithType($type)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$type]);
    }
    public function GetAllPostWithTypeAndUserID($type, $userID)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? and p.user_id = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$type, $userID]);
    }
    public function GetPostWithTypeAndLimit($type, $limit)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        return $this->executeSelectQuery($sql, [$type, $limit]);
    }

    public function GetPostByID($id)
    {
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.id = ?";
        return $this->executeSelectQuery($sql, [$id]);
    }

    public function CreatePost($title, $content, $user_id, $category_id, $type)
    {
        $sql = "INSERT INTO posts(title, content, user_id, category_id, type) values (?,?,?,?,?)";
        $result = $this->executeQuery($sql, [$title, $content, $user_id, $category_id, $type]);

        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }

    public function IncrementView($number, $id)
    {
        $sql = "UPDATE posts set views = views + ? where id = ?";
        return $this->executeQuery($sql, [$number, $id]);
    }
}