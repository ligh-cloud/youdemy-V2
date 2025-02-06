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
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];

            try {
                $user = $this->userModel::signin($data['email'], $data['password']);
                // Check the user role and redirect accordingly
                switch ($user->role) {
                    case 1: // Admin
                        $this->view('admin/admin_dashboard');
                        break;
                    case 2: // Teacher
                        $this->view('teacher/teacher');
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