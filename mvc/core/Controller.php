<?php
class Controller
{

     protected function model($model)
     {
          require_once "./mvc/models/" . $model . ".php";
          return new $model;
     }

     protected function view($view, $data = [])
     {
          extract($data);
          require_once "./mvc/views/" . $view . ".php";
     }

     protected function response($layout, $page, $title, $data)
     {
          $this->view($layout, [
               "Page" => $page,
               "title" => $title,
               "data" => $data
          ]);
     }

}

?>