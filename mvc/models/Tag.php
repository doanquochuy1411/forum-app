<?php
class Tag extends DB
{
    public function GetTagByName($name)
    {
        $sql = "SELECT * FROM tags Where name = ?";
        $result = $this->executeSelectQuery($sql, [$name]);
        if ($result && $result->num_rows > 0) {
            // Lấy kết quả
            $row = $result->fetch_assoc();
            return $row['id']; // Trả về ID của tag
        } else {
            return false; // Tag không tồn tại
        }
    }
    public function GetTagsOfPost($post_id)
    {
        $sql = "SELECT * FROM tags t JOIN post_tags pt ON t.id = pt.tag_id Where pt.post_id = ?";
        return $this->executeSelectQuery($sql, [$post_id]);
    }
    public function GetPopularTags()
    {
        $sql = "SELECT distinct t.id, t.name FROM tags t JOIN post_tags pt ON t.id = pt.tag_id JOIN posts p ON pt.post_id = p.id ORDER BY p.views DESC;";
        return $this->executeSelectQuery($sql);
    }
    public function CreateTag($name)
    {
        $sql = "INSERT INTO tags(name) values (?)";
        $result = $this->executeQuery($sql, [$name]);

        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }
    public function DeleteTag($name)
    {
        $sql = "DELETE FROM tags WHERE name =?";
        return $this->executeQuery($sql, [$name]);
    }
    public function AddTag($post_id, $tag_id)
    {
        $sql = "INSERT INTO post_tags (post_id, tag_id) values (?,?)";
        return $this->executeQuery($sql, [$post_id, $tag_id]);
        if ($this->con->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}