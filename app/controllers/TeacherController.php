<?php
require_once APPROOT . '/models/Course.php';
require_once APPROOT . '/models/Category.php';
require_once APPROOT . '/models/Tag.php';
session_start();

class TeacherController extends Controller {
    public function __construct() {
        // Ensure the user is logged in and has teacher privileges
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
            header("Location: " . URLROOT . "/userController/signin");
            exit();
        }
    }

    public function index() {
        $this->view('teacher/dashboard');
    }
    public function addCourseDash() {
        $this->view('teacher/addCourse');
    }

    public function addCourse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $tag = $_POST['tag'];
            $document = $_FILES['document'];
            $image = $_FILES['image'];
            $video = $_FILES['video'];

            // Add course
            $courseModel = new Course();
            if ($courseModel->addCourse($title, $description, $category, $tag, $document, $image, $video)) {
                $_SESSION['success'] = 'Course added successfully';
                header("Location: " . URLROOT . "/TeacherController/addCourse");
            } else {
                $_SESSION['error'] = 'Failed to add course';
                $this->view('teacher/addcourse');
            }
            exit();
        } else {
            $categoryModel = new Category();
            $allCategories = $categoryModel->getAllCategories();
            $allTags = Tag::getAllTagsSelect();
            $courseModel = new Course();
            $allCourses = $courseModel->getAllCourses();
            $totalCourse = $courseModel->getTotalCourses();
            $data = [
                'allCategories' => $allCategories,
                'allTags' => $allTags,
                'allCourses' => $allCourses,
                'totalCourses' => $totalCourse
            ];

            $this->view('teacher/teacher', $data);
        }
    }
}
?>