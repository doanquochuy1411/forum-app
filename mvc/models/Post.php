<?php
class Post extends DB
{
    public function GetAllPostWithType($type)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$type]);
    }
    // Lấy tất cả bài viết || câu hỏi
    public function GetAllPostWithCategoryAndType($category_id, $type)
    {
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.category_id = ? and p.type = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$category_id, $type]);
    }
    // Lấy tất cả bài viết || câu hỏi với từ khóa cần tìm kiếm
    // public function GetPostBySearch($txt)
    // {
    //     // Tách từ khóa tìm kiếm thành các từ riêng lẻ
    //     $keywords = explode(' ', $txt);
    //     $placeholders = [];
    //     $searchTerms = [];

    //     // Tạo các placeholder và các từ tìm kiếm cho từng từ khóa
    //     foreach ($keywords as $keyword) {
    //         if (!empty($keyword)) {
    //             $placeholders[] = "(t.name LIKE ? OR p.content LIKE ? OR p.title LIKE ?)";
    //             $searchTerms[] = '%' . $keyword . '%';
    //             $searchTerms[] = '%' . $keyword . '%';
    //             $searchTerms[] = '%' . $keyword . '%';
    //         }
    //     }

    //     // Kết hợp các placeholder với toán tử OR
    //     $placeholders = implode(' OR ', $placeholders);

    //     $sql = "SELECT DISTINCT p.*, u.user_name, u.image as avatar, pcc.comment_count 
    //             FROM posts p 
    //             JOIN user u ON u.id = p.user_id 
    //             JOIN post_comment_counts pcc ON pcc.post_id = p.id 
    //             LEFT JOIN post_tags pt ON pt.post_id = p.id 
    //             LEFT JOIN tags t ON t.id = pt.tag_id
    //             WHERE p.deleted_at IS NULL 
    //             AND (

    //                 $placeholders
    //             )
    //             ORDER BY p.created_at DESC;";
    //     // Sử dụng ký tự đại diện `%` để tìm kiếm các chuỗi chứa từ khóa
    //     $searchTerm = '%' . $txt . '%';
    //     return $this->executeSelectQuery($sql, $searchTerms);
    // }
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
                   ($keywordMatchScore) AS match_score
            FROM posts p 
            JOIN user u ON u.id = p.user_id 
            JOIN post_comment_counts pcc ON pcc.post_id = p.id 
            LEFT JOIN post_tags pt ON pt.post_id = p.id 
            LEFT JOIN tags t ON t.id = pt.tag_id
            WHERE p.deleted_at IS NULL 
            AND ($placeholders)
            ORDER BY match_score DESC, p.created_at DESC;";

        return $this->executeSelectQuery($sql, $searchTerms);
    }

    // Lấy tất cả bài viết || câu hỏi với tags
    public function GetPostByTag($txt)
    {
        $sql = "SELECT DISTINCT p.*, u.user_name, u.image as avatar, pcc.comment_count, u.account_name
                FROM posts p 
                JOIN user u ON u.id = p.user_id 
                JOIN post_comment_counts pcc ON pcc.post_id = p.id 
                LEFT JOIN post_tags pt ON pt.post_id = p.id 
                LEFT JOIN tags t ON t.id = pt.tag_id
                WHERE p.deleted_at IS NULL AND t.name LIKE ? 
                ORDER BY p.created_at DESC;";
        // Sử dụng ký tự đại diện `%` để tìm kiếm các chuỗi chứa từ khóa
        $searchTerm = '%' . $txt . '%';
        return $this->executeSelectQuery($sql, [$searchTerm]);
    }
    // Lấy tất cả bài viết và câu hỏi của danh mục
    public function GetAllPostWithCategory($category_id)
    {
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.category_id = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$category_id]);
    }
    public function GetAllPostWithTypeAndUserID($type, $userID)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? and p.user_id = ? order by p.created_at DESC";
        return $this->executeSelectQuery($sql, [$type, $userID]);
    }
    public function GetPostWithTypeAndLimit($type, $limit)
    {
        // $sql = "SELECT p.*, c.content as comment_content, c.created_at as comment_created_at, a.* FROM posts p left join likes l on l.post_id = p.id left join comments c on c.post_id = p.id left join attachments a on a.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.type = ? order by p.created_at DESC limit ?";
        return $this->executeSelectQuery($sql, [$type, $limit]);
    }

    public function GetPostByID($id)
    {
        $sql = "SELECT p.* , u.user_name, u.image as avatar, pcc.comment_count, u.account_name FROM posts p left join user u on u.id = p.user_id left join post_comment_counts pcc on pcc.post_id = p.id Where p.deleted_at is null and p.id = ?";
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

    public function GetRelatePosts($post_id, $limit)
    {
        $sql = "SELECT DISTINCT p2.* FROM posts p1 
            JOIN post_tags pt1 ON p1.id = pt1.post_id 
            JOIN post_tags pt2 ON pt1.tag_id = pt2.tag_id 
            JOIN posts p2 ON pt2.post_id = p2.id WHERE p1.id = ?
            AND p2.id != ? order by p2.views DESC LIMIT ?";
        return $this->executeSelectQuery($sql, [$post_id, $post_id, $limit]);
    }

    public function UpdatePost($id, $title, $content, $category_id, $type)
    {
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
        $sql = "UPDATE posts set deleted_at = NOW() Where id = ?";
        $result = $this->executeQuery($sql, [$id]);

        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}