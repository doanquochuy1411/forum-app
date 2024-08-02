<?php
require __DIR__ . '/../../vendor/autoload.php'; 

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..'); 
$dotenv->load();

    class DB {
        public $con;
        protected $servername;
        protected $username;
        protected $password;
        protected $dbname;
        
        function __construct(){
            $this->servername = $_ENV['DB_SERVERNAME'];
            $this->username = $_ENV['DB_USERNAME'];
            $this->password = $_ENV['DB_PASSWORD'];
            $this->dbname = $_ENV['DB_NAME'];

            $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            
            if ($this->con->connect_error) {
                die("fail to connect database: " . $this->con->connect_error);
            }

            $this->con->set_charset('utf8');
        }

        public function executeQuery($sql, $params = []) {
            $stmt = $this->con->prepare($sql);
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($this->con->error));
            }
    
            if (!empty($params)) {
                $types = str_repeat('s', count($params)); // Assuming all params are strings
                $stmt->bind_param($types, ...$params);
            }
    
            $success = $stmt->execute();
            if ($success) {
                if ($stmt->affected_rows > 0) {
                    $result = $stmt->affected_rows;
                } else {
                    $result = $stmt->get_result();
                }
            } else {
                $result = false;
            }
    
            $stmt->close();
            return $result;
        }
    }

?>