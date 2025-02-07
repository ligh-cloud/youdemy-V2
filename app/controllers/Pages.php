<?php
class Pages extends Controller {
    public function __construct() {
        // No model needed for now
    }

    public function index() {
        $this->view('pages/index');
    }

    public function about($id) {
        echo $id;
    }

    public function signup() {
        $this->view('pages/signup');
    }

    public function signin() {
        $this->view('pages/signin');
    }
}
?>