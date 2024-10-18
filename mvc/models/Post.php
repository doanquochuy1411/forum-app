<?php
class Post extends DB
{
    public function GetAllPostWithType($type)
    {
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, pcc.report_count, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC";
        $result = $this->executeSelectQuery($sql, [$type]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }

    // Lấy tất cả bài viết || câu hỏi
    public function GetAllPostWithCategoryAndType($category_id, $type)
    {
        $category_id = decryptData($category_id);
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.category_id = ? and p.type = ? order by p.created_at DESC";
        $result = $this->executeSelectQuery($sql, [$category_id, $type]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }

    public function GetPostBySearch($txt)
    {
        // Tách từ khóa tìm kiếm thành các từ riêng lẻ
        $keywords = explode(' ', $txt);
        $placeholders = [];
        $searchTerms = [];
        $keywordMatches = [];

        // Tạo các placeholder và các từ tìm kiếm cho từng từ khóa
        foreach ($keywords as $keyword) {
            if (!empty($keyword)) {
                $placeholders[] = "(t.name LIKE ? OR p.content LIKE ? OR p.title LIKE ?)";
                $searchTerms[] = '%' . $keyword . '%';
                $searchTerms[] = '%' . $keyword . '%';
                $searchTerms[] = '%' . $keyword . '%';

                // Đếm số lần match với mỗi từ khóa
                $keywordMatches[] = "(CASE WHEN t.name LIKE ? THEN 1 ELSE 0 END 
                                 + CASE WHEN p.content LIKE ? THEN 1 ELSE 0 END 
                                 + CASE WHEN p.title LIKE ? THEN 1 ELSE 0 END)";
                $searchTerms[] = '%' . $keyword . '%';
                $searchTerms[] = '%' . $keyword . '%';
                $searchTerms[] = '%' . $keyword . '%';
            }
        }

        // Kết hợp các placeholder với toán tử OR
        $placeholders = implode(' OR ', $placeholders);

        // Tính tổng số lần match từ khóa cho mỗi bài viết
        $keywordMatchScore = implode(' + ', $keywordMatches);

        $sql = "SELECT DISTINCT p.*, u.user_name, u.image as avatar, pcc.comment_count,
                   ($keywordMatchScore) AS match_score, pcc.like_count
            FROM posts p 
            JOIN user u ON u.id = p.user_id 
            JOIN post_comment_counts pcc ON pcc.post_id = p.id 
            LEFT JOIN post_tags pt ON pt.post_id = p.id 
            LEFT JOIN tags t ON t.id = pt.tag_id
            WHERE p.deleted_at IS NULL 
            AND ($placeholders)
            ORDER BY match_score DESC, p.created_at DESC;";

        $result = $this->executeSelectQuery($sql, $searchTerms);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }

    // Lấy tất cả bài viết || câu hỏi với tags
    public function GetPostByTag($txt)
    {
        $sql = "SELECT DISTINCT p.*, u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count
                FROM posts p 
                JOIN user u ON u.id = p.user_id 
                JOIN post_comment_counts pcc ON pcc.post_id = p.id 
                LEFT JOIN post_tags pt ON pt.post_id = p.id 
                LEFT JOIN tags t ON t.id = pt.tag_id
                WHERE p.deleted_at IS NULL AND LOWER(t.name) LIKE LOWER(?) 
                ORDER BY p.created_at DESC;";
        // Sử dụng ký tự đại diện `%` để tìm kiếm các chuỗi chứa từ khóa
        $searchTerm = '%' . $txt . '%';
        $result = $this->executeSelectQuery($sql, [$searchTerm]);
        // $result = $this->executeSelectQuery($sql, [$type, $limit]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }
    // Lấy tất cả bài viết và câu hỏi của danh mục
    public function GetAllPostWithCategory($category_id)
    {
        $category_id = decryptData($category_id);
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.category_id = ? order by p.created_at DESC";
        $result = $this->executeSelectQuery($sql, [$category_id]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }
    public function GetAllPostWithTypeAndUserID($type, $userID)
    {
        if ($userID != "") {
            $userID = decryptData($userID);
        }
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? and p.user_id = ? order by p.created_at DESC";
        $result = $this->executeSelectQuery($sql, [$type, $userID]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }
    public function GetPostWithTypeAndLimit($type, $limit = 0)
    {
        if ($limit != 0) {
            $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
            $result = $this->executeSelectQuery($sql, [$type, $limit]);
        } else {
            $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC";
            $result = $this->executeSelectQuery($sql, [$type]);
        }
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
            $row['account_name'] = encryptData($row['account_name']);
        }

        return $data;
    }

    public function GetPostByID($id)
    {
        $id = decryptData($id);
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name, pcc.like_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.id = ?";
        $result = $this->executeSelectQuery($sql, [$id]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
            $row['user_id'] = encryptData($row['user_id']);
        }

        return $data;
    }

    public function CreatePost($title, $content, $user_id, $category_id, $type)
    {
        $user_id = decryptData($user_id);
        $category_id = decryptData($category_id);
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
        $id = decryptData($id);
        $sql = "UPDATE posts set views = views + ? where id = ?";
        return $this->executeQuery($sql, [$number, $id]);
    }

    public function GetRelatePosts($post_id, $limit)
    {
        $post_id = decryptData($post_id);
        $sql = "SELECT DISTINCT p2.* FROM posts p1 
            JOIN post_tags pt1 ON p1.id = pt1.post_id 
            JOIN post_tags pt2 ON pt1.tag_id = pt2.tag_id 
            JOIN posts p2 ON pt2.post_id = p2.id WHERE p1.id = ?
            AND p2.id != ? order by p2.views DESC LIMIT ?";
        $result = $this->executeSelectQuery($sql, [$post_id, $post_id, $limit]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }

    public function UpdatePost($id, $title, $content, $category_id, $type)
    {
        $id = decryptData($id);
        $category_id = decryptData($category_id);
        $sql = "UPDATE posts set title = ?, content=?, category_id=?, type= ? where id = ?";
        $result = $this->executeQuery($sql, [$title, $content, $category_id, $type, $id]);

        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    // Soft delete
    public function DeletePost($id)
    {
        $id = decryptData($id);
        $sql = "UPDATE posts set deleted_at = NOW() Where id = ?";
        $result = $this->executeQuery($sql, [$id]);

        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function GetAuthOfPost($post_id)
    {
        $id = decryptData($post_id);
        $sql = "select user_id from posts where id = ?";
        $result = $this->executeSelectQuery($sql, [$id]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function GetPostAmountPerMonthByYear($year)
    {
        $sql = "SELECT 
            MONTH(created_at) AS month, 
            COUNT(*) AS post_count
        FROM 
            posts
        WHERE 
            YEAR(created_at) = ?
        GROUP BY 
            MONTH(created_at)
        ORDER BY 
            month ASC;
        ";
        return $this->executeSelectQuery($sql, [$year]);
    }

    public function CheckLikedPostByUser($user_id, $post_id)
    {
        $user_id = decryptData($user_id);
        $post_id = decryptData($post_id);
        $sql = "SELECT id FROM likes WHERE post_id = ? AND user_id = ?";
        $result = $this->executeSelectQuery($sql, [$post_id, $user_id]);
        if ($result->num_rows > 0) {
            return true; // liked
        }
        return false;
    }

    public function CancelLikedPostByUser($user_id, $post_id)
    {
        $user_id = decryptData($user_id);
        $post_id = decryptData($post_id);
        $sql = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
        return $this->executeQuery($sql, [$post_id, $user_id]);
    }

    public function CreateLikedPostByUser($user_id, $post_id)
    {
        $user_id = decryptData($user_id);
        $post_id = decryptData($post_id);
        $sql = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
        return $this->executeQuery($sql, [$post_id, $user_id]);
    }

    public function CountLikedOfPost($post_id)
    {
        $post_id = decryptData($post_id);
        $sql = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?";
        $result = $this->executeSelectQuery($sql, [$post_id]);
        return $result->fetch_assoc()['like_count'];
    }
}