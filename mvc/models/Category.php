<?php
class Category extends DB
{
    public function GetAllCategory()
    {
        $sql = "SELECT * FROM categories order by id DESC";
        $result = $this->executeSelectQuery($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;

    }
    public function GetCategoryByID($category_id)
    {
        $category_id = decryptData($category_id);
        $sql = "SELECT * FROM categories WHERE id = ?";
        $result = $this->executeSelectQuery($sql, [$category_id]);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($data as &$row) {
            $row['id'] = encryptData($row['id']);
        }

        return $data;
    }

    public function CreateCategory($category_name, $category_description)
    {
        $sql = "Insert into categories(name, description) values (?,?)";
        $result = $this->executeQuery($sql, [$category_name, $category_description]);
        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }

    public function DeleteCategoryByID($category_id)
    {
        $category_id = decryptData($category_id);
        $re_sql = "select count(id) as total_posts from posts where category_id = $category_id";


        $result = $this->con->query($re_sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $total_posts = $row['total_posts'];
            if ($total_posts > 0) {
                return $total_posts; // danh mục có chứa bài viết    
            }
        }

        $sql = "DELETE FROM categories WHERE id = ?";
        $result = $this->executeQuery($sql, [$category_id]);
        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }

    }
}