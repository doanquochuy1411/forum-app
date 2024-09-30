<?php
class App
{

    protected $controller = 'Home';
    protected $action = 'Index';
    protected $params = [];

    function __construct()
    {
        $arr = $this->UrlProcess();
        // Handle Controller
        if (isset($arr[0])) {
            $controllerName = ucfirst($arr[0]); // Capitalize the first letter
            if (file_exists("./mvc/controllers/" . $controllerName . ".php")) {
                $this->controller = $controllerName;
                unset($arr[0]);
            } else {
                $this->controller = 'Errors';
            }
        }
        require_once "./mvc/controllers/" . $this->controller . ".php";
        // $this->controller = new $this->controller;

// $path = "./mvc/controllers/" . $this->controller . ".php";
// if (file_exists($path)) {
//     echo "Đường dẫn tồn tại!";
// } else {
//     echo "Đường dẫn không tồn tại.";
// }
// echo "<br>";
        // Instantiate controller
        // print_r("First time : " . $this->controller);
        try {
            $this->controller = new $this->controller;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        // print_r("Second time : " .$this->controller);
        // Handle Action (method)
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }

        // Handle Params
        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    function UrlProcess()
    {
        // print_r($_GET["url"]);
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
?>