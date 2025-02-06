<?php
class Controller {
    public function model($model, $params = []) {
        require_once '../app/models/' . $model . '.php';
        return new $model(...$params);
    }

    public function view($view, $data = []) {
        if(file_exists('../app/views/' . $view . '.php')) {
            extract($data);
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exist.");
        }
    }
}
?>