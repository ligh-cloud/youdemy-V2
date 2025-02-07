<?php
require_once APPROOT . '/libraries/Database.php';

class Course {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addCourse($title, $description, $category, $tag, $document, $image, $video) {
        $sql = "INSERT INTO courses (title, description, categorie_id, content, image, video) VALUES (:title, :description, :category, :document, :image, :video)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':document', $document['name']);
        $stmt->bindParam(':image', $image['name']);
        $stmt->bindParam(':video', $video['name']);

        // Move uploaded files to desired directory
        move_uploaded_file($document['tmp_name'], APPROOT . '/uploads/documents/' . $document['name']);
        move_uploaded_file($image['tmp_name'], APPROOT . '/uploads/images/' . $image['name']);
        move_uploaded_file($video['tmp_name'], APPROOT . '/uploads/videos/' . $video['name']);

        return $stmt->execute();
    }

    public function getTotalCourses() {
        $sql = "SELECT COUNT(*) as total FROM courses";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }

    public function getCoursesByCategory() {
        $sql = "SELECT category.nom, COUNT(*) as total FROM courses JOIN category ON courses.categorie_id = category.id GROUP BY category.nom";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCourseWithMostStudents() {
        $sql = "SELECT title, COUNT(student_id) as students FROM courses JOIN course_enrollments ON courses.id = course_enrollments.course_id GROUP BY courses.id ORDER BY students DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>