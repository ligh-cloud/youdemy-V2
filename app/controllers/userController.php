<?php
session_start();

class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('Users');
    }

    public function index() {
        $this->view('user/index');
    }
    public function signout() {
        session_unset();
        session_destroy();
        header("Location: " . URLROOT );
        exit();
    }
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nom' => trim($_POST['Fname']),
                'prenom' => trim($_POST['Lname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role' => trim($_POST['role'])
            ];

            try {
                $this->userModel::register($data['nom'], $data['prenom'], $data['email'], $data['role'], $data['password']);
                error_log("Redirecting to signin page after successful registration.");
                $_SESSION['signup_success'] = true; // Set session variable
                header('Location: ' . URLROOT . '/user/signin');
                exit();
            } catch (Exception $e) {
                $data['error'] = $e->getMessage();
                $_SESSION['error'] = $e->getMessage();
                error_log("Error during registration: " . $e->getMessage());
                $this->view('user/signup', $data);
            }
        } else {
            $data = [
                'nom' => '',
                'prenom' => '',
                'email' => '',
                'password' => '',
                'role' => ''
            ];
            $this->view('user/signup');
        }
    }

    public function signin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                'totalCourses' => $totalCourse,
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];
            $data2 = [
                'totalCourses' => Course::getTotalCourses(),
                'coursesByCategory' => $courseModel->getAllCourses(),
                'courseWithMostStudents' => Course::getCourseWithMostStudents(),
                'topTeachers' => Teacher::getTopTeachers()
            ];


            try {
                $user = $this->userModel::signin($data['email'], $data['password']);
                // Check the user role and redirect accordingly
                switch ($_SESSION['role']) {
                    case 1: // Admin

                        $this->view('admin/admin_dashboard' , $data2 );
                        break;
                    case 2: // Teacher
                        $this->view('teacher/teacher' , $data);
                        break;
                    case 3: // Student
                        $this->view('user/student');
                        break;
                    default:
                        throw new Exception("Invalid role!");
                }
                exit();
            } catch (Exception $e) {
                $data['error'] = $e->getMessage();
                $this->view('user/signin', $data);
            }
        } else {
            $this->view('user/signin');
        }
    }

    public function profile() {
        $this->view('user/profile');
    }


}
?>