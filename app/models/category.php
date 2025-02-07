<?php
require_once APPROOT . '/libraries/Database.php';

class Category {
    private $db;
    private $category;
    private $description;

    public function __construct($category = null, $description = null) {
        $this->db = Database::getInstance()->getConnection();
        $this->category = $category;
        $this->description = $description;
    }

    public function addCategory() {
        $stmt = $this->db->prepare("INSERT INTO categories (nom, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', $this->category);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
    }

    public function getAllCategories($offset = 0, $limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM categories LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoriesCount() {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM categories");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function deleteCategory($categoryId) {
        $db = Database::getInstance()->getConnection();
        try {
            $db->beginTransaction();

            $checkStmt = $db->prepare("SELECT * FROM categories WHERE id = :id");
            $checkStmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $checkStmt->execute();

            $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $result = $stmt->execute();

            $db->commit();
            return $result;
        } catch (PDOException $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log("Error deleting category: " . $e->getMessage());
            return false;
        }
    }
}
?>