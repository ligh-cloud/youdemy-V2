<?php
require_once APPROOT . '/libraries/Database.php';

class Tag {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addTags($tags) {
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if (!empty($tag)) {
                $stmt = $this->db->prepare("INSERT IGNORE INTO tags (tag_name) VALUES (:name)");
                $stmt->bindParam(':name', $tag);
                $stmt->execute();
            }
        }
    }

    public function getAllTags($offset, $limit) {
        $stmt = $this->db->prepare("SELECT * FROM tags LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllTagsSelect() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagsCount() {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM tags");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function deleteTag($tagId) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM tags WHERE id_tag = :id");
            $stmt->bindParam(':id', $tagId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Can't delete tag: " . $e->getMessage());
        }
    }
}
?>