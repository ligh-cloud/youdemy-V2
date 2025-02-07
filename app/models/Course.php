<?php
require_once APPROOT . '/libraries/Database.php';

class Course {


    private $db;



    public function addCourse($title, $description, $category, $tag, $document, $image, $video)
    {
        $db = Database::getInstance()->getConnection();
        $this->db->query("INSERT INTO courses (title, description, category_id, tag_id, document, image, video) VALUES (:title, :description, :category, :tag, :document, :image, :video)");
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':category', $category);
        $this->db->bind(':tag', $tag);
        $this->db->bind(':document', $document['name']);
        $this->db->bind(':image', $image['name']);
        $this->db->bind(':video', $video['name']);

        // Move uploaded files to desired directory
        move_uploaded_file($document['tmp_name'], APPROOT . '/uploads/documents/' . $document['name']);
        move_uploaded_file($image['tmp_name'], APPROOT . '/uploads/images/' . $image['name']);
        move_uploaded_file($video['tmp_name'], APPROOT . '/uploads/videos/' . $video['name']);

        return $db->execute();
    }


public  function getTotalCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT COUNT(*) as total FROM courses");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public  function getCoursesByCategory() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT category.nom, COUNT(*) as total FROM courses JOIN category ON courses.category_id = category.id GROUP BY category.nom");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public  function getCourseWithMostStudents() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT title, COUNT(student_id) as students FROM courses JOIN course_enrollments ON courses.id = course_enrollments.course_id GROUP BY courses.id ORDER BY students DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>