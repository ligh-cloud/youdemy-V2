<?php
require "database.php";

class Enrollment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }


    public function addEnrollment($courseId, $userId) {
        try {
            $stmt = $this->db->prepare("INSERT INTO enrollenment (id_course, id_user) VALUES (:course_id, :user_id)");
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return "Enrollment added successfully.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function removeEnrollment($courseId, $userId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM enrollenment WHERE id_course = :course_id AND id_user = :user_id");
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return "Enrollment removed successfully.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function isEnrolled($courseId, $userId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM enrollenment WHERE id_course = :course_id AND id_user = :user_id");
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $enrollment = $stmt->fetch(PDO::FETCH_ASSOC);
            return $enrollment ? true : false;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function getEnrollmentsByCourse($courseId) {
        try {
            $stmt = $this->db->prepare("SELECT users.id, users.nom, users.prenom, users.email 
                                        FROM enrollenment 
                                        JOIN users ON enrollenment.id_user = users.id 
                                        WHERE enrollenment.id_course = :course_id");
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function getEnrollmentsByUser($userId) {
        try {
            $stmt = $this->db->prepare("SELECT courses.id_course, courses.title, courses.description 
                                        FROM enrollenment 
                                        JOIN courses ON enrollenment.id_course = courses.id_course 
                                        WHERE enrollenment.id_user = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function getNumberEnrollmentsByUser($userId){
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) AS enrollment_count FROM enrollenment WHERE id_course = :course_id");
    $stmt->bindParam(':course_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}