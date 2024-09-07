<?php
class User extends DB
{
    public function GetAllUser()
    {
        $sql = "SELECT * FROM user Where deleted_at is null";
        return $this->executeSelectQuery($sql);
    }
    public function GetAllUserDescWithOrderBy($orderBy)
    {
        $sql = "SELECT * FROM user Where deleted_at is null order by ? DESC";
        return $this->executeSelectQuery($sql, [$orderBy]);
    }
    public function GetUserByID($userID)
    {
        $sql = "SELECT * FROM user Where deleted_at is null and id = ?";
        return $this->executeSelectQuery($sql, [$userID]);
    }

    public function GetUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE deleted_at IS NULL AND email = ?";
        $result = $this->executeSelectQuery($sql, [$email]);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if (!empty($data)) {
            return $data[0];
        }

        return null;
    }

    public function GetUserByAccountName($account_name)
    {
        $sql = "SELECT u.*, ur.role_id, uas.total_posts, uas.total_questions, uas.total_comments FROM user u Join user_role ur on ur.user_id = u.id join user_activity_summary uas on uas.user_id = u.id WHERE u.deleted_at IS NULL AND u.account_name = ?";
        $result = $this->executeSelectQuery($sql, [$account_name]);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if (!empty($data)) {
            return $data[0];
        }

        return null;
    }
    public function UpdateLoginAttempts($account_name)
    {
        $sql = "UPDATE user SET login_attempts = login_attempts + 1 WHERE account_name = ?";
        return $this->executeQuery($sql, [$account_name]);
    }
    public function ResetLoginAttempts($account_name)
    {
        $sql = "UPDATE user SET login_attempts = 0 WHERE account_name = ?";
        return $this->executeQuery($sql, [$account_name]);
    }
    public function ResetLoginAttemptsWithEmail($email)
    {
        $sql = "UPDATE user SET login_attempts = 0 WHERE email = ?";
        return $this->executeQuery($sql, [$email]);
    }
    public function UpdateLocked($account_name)
    {
        $sql = "UPDATE user SET locked = 1 WHERE account_name = ?";
        return $this->executeQuery($sql, [$account_name]);
    }
    public function ResetLocked($account_name)
    {
        $sql = "UPDATE user SET locked = 0 WHERE account_name = ?";
        return $this->executeQuery($sql, [$account_name]);
    }
    public function ResetLockedWithEmail($email)
    {
        $sql = "UPDATE user SET locked = 0 WHERE email = ?";
        return $this->executeQuery($sql, [$email]);
    }
    public function UpdatePassword($email, $password)
    {
        $sql = "UPDATE user SET password = ? WHERE email = ?";
        return $this->executeQuery($sql, [$password, $email]);
    }

    public function CreateUser($account_name, $user_name, $email, $password)
    {
        $sql = "INSERT INTO user(account_name, user_name, email, password) values (?,?,?,?)";
        return $this->executeQuery($sql, [$account_name, $user_name, $email, $password]);
    }

    public function GetAllRole()
    {
        $sql = "SELECT * FROM role";
        return $this->executeQuery($sql);
    }

    public function SetRole($userID, $roleID)
    {
        $sql = "INSERT INTO user_role(user_id, role_id) values (?,?)";
        return $this->executeQuery($sql, [$userID, $roleID]);
    }

}
?>