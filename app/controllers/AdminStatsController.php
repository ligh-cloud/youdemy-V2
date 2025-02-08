<?php
class AdminStatsController extends Controller {
    public function __construct() {
        // Ensure the user is logged in and has admin privileges
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            header("Location: " . URLROOT . "/userController/signin");
            exit();
        }
    }

    public function index() {
        $data = [
            'totalCourses' => Course::getTotalCourses(),
//            'coursesByCategory' => Course::getCoursesByCategory(),
            'courseWithMostStudents' => Course::getCourseWithMostStudents(),
            'topTeachers' => Teacher::getTopTeachers()
        ];

        $this->view('admin/admin_stats', $data);
    }
}
?>