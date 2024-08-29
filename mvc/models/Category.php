<?php
class Category extends DB
{
    public function GetAllCategory()
    {
        $sql = "SELECT * FROM categories order by id DESC";
        return $this->executeSelectQuery($sql);
    }
}