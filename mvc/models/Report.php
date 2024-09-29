<?php
class Report extends DB
{
    public function CreateReport($post_id, $reason, $reported_by)
    {
        $post_id = decryptData($post_id);
        $reported_by = decryptData($reported_by);
        $sql = "INSERT INTO reports(post_id, reason, reported_by) values (?,?,?)";
        $result = $this->executeQuery($sql, [$post_id, $reason, $reported_by]);

        if ($result > 0) {
            return $this->con->insert_id;
        } else {
            return 0;
        }
    }
}