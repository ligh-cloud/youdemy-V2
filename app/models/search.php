<?php
require_once "database.php";

class Search {
    static function searchCourses($searchTerm = '') {
        try {
            $db = Database::getInstance()->getConnection();
            
            $query = "
                SELECT DISTINCT 
                    c.id_course,
                    c.title,
                    c.description,
                    c.image,
                    c.video,
                    c.content,
                    u.nom as teacher_name,
                    u.prenom as teacher_firstname,
                    cat.nom as category_name,
                    GROUP_CONCAT(DISTINCT t.tag_name) as tags
                FROM courses c
                LEFT JOIN users u ON c.teacher_id = u.id
                LEFT JOIN categories cat ON c.categorie_id = cat.id
                LEFT JOIN CourseTags ct ON c.id_course = ct.id_course
                LEFT JOIN tags t ON ct.id_tag = t.id_tag
                WHERE u.ban = 'false' 
                AND u.enseignant = 'accepted'
            ";
            
            $params = [];
            
            if (!empty($searchTerm)) {
                $query .= " AND (
                    c.title LIKE :term 
                    OR c.description LIKE :term
                    OR u.nom LIKE :term
                    OR u.prenom LIKE :term
                    OR cat.nom LIKE :term
                    OR t.tag_name LIKE :term
                )";
                $params[':term'] = '%' . trim($searchTerm) . '%';
            }
            
            $query .= " GROUP BY c.id_course ORDER BY c.title ASC";
            
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Search error: " . $e->getMessage());
            return [];
        }
    }
}