<?php
class Pages extends Controller {
    public function __construct() {
        // No model needed for now
    }

    public function index() {
        $course = new Course();
        $data = [
            "categories" => Category::getAll(),
            "courses" => $course->getAllCourses()
        ];
        $this->view('pages/index', $data);
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