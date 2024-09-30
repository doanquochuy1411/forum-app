<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

class DB
{
    public $con;
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;

    function __construct()
    {
        $this->servername = $_ENV['DB_SERVERNAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_NAME'];
        $_SESSION['Key'] = $_ENV["KEY"]; // Lấy key
        $_SESSION['SECRET_KEY'] = $_ENV["SECRET_KEY"]; // Lấy secret key -> BE
        $_SESSION['PUBLIC_KEY'] = $_ENV["PUBLIC_KEY"]; // Lấy public key => FE
        $_SESSION['SCAN_KEY'] = $_ENV["SCAN_KEY"]; // Lấy scan key => scan image
        // echo "<br>";
        // printf($this->servername);
        // printf($this->username);
        // printf($this->password);
        // printf($this->dbname);
        // echo "<br>";

        $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->con->connect_error) {
             $errorMessage = "Fail to connect to database: " . $this->con->connect_error;
            
            // Ghi lại lỗi vào file log
            error_log($errorMessage, 3, __DIR__ . '/db_errors.log');
            
            // Hiển thị thông báo lỗi
            die($errorMessage);
        }

        $this->con->set_charset('utf8');
    }

    // INSERT QUERY
    public function executeQuery($sql, $params = [])
    {
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->con->error));
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all params are strings
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        if (!$success) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        // $result = $stmt->get_result();
        $result = $stmt->affected_rows > 0;
        $stmt->close();
        return $result;
    }

    // SELECT QUERY
    public function executeSelectQuery($sql, $params = [])
    {
        $stmt = $this->con->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->con->error));
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all params are strings
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();
        if (!$success) {

            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        $result = $stmt->get_result();
        // $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }
}

?>