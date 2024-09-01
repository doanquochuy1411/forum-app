<?php
class Category extends DB
{
    public function GetAllCategory()
    {
        $sql = "SELECT * FROM categories order by id DESC";
        return $this->executeSelectQuery($sql);
    }
    public function GetCategoryByID($category_id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->executeSelectQuery($sql, [$category_id]);
    }
}