<?php
require_once '../../app/models/Course.php';
require_once '../../app/models/Category.php';
require_once '../../app/models/Tag.php';

class TeacherController {
    public function __construct() {
        // Ensure the user is logged in and has teacher privileges
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
            header("Location: " . URLROOT . "/userController/signin");
            exit();
        }
    }

    public function addCourse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $tag = $_POST['tag'];
            $document = $_FILES['document'];
            $image = $_FILES['image'];
            $video = $_FILES['video'];

            $course = new Course();
            $course->addCourse($title, $description, $category, $tag, $document, $image, $video);

            header("Location: " . URLROOT . "/teacher/dashboard");
            exit();
        } else {
            $category = new Category();
            $allCategories = $category->getAllCategories();
            $allTags = Tag::getAllTagsSelect();

            $data = [
                'allCategories' => $allCategories,
                'allTags' => $allTags
            ];

            $this->view('teacher/addcourse', $data);
        }
    }

    private function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}
?>