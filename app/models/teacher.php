<?php

require_once 'User.php';

class Teacher extends User
{
    protected $enseignant;

    public function __construct($id = null, $nom = null, $prenom = null, $email = null, $role = 2, $password = null, $enseignant = 'waiting')
    {
        parent::__construct($id, $nom, $prenom, $email, $role, $password);
        $this->enseignant = $enseignant;
    }

    public function save()
    {
        $db = Database::getInstance()->getConnection();
        try {
            if ($this->id) {
                $stmt = $db->prepare("
                    UPDATE users 
                    SET nom = :nom, prenom = :prenom, email = :email, role_id = :role_id, enseignant = :enseignant, ban = :ban
                    WHERE id = :id
                ");
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':role_id', $this->role, PDO::PARAM_INT);
                $stmt->bindParam(':enseignant', $this->enseignant, PDO::PARAM_STR);
                $stmt->bindParam(':ban', $this->ban, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                $stmt = $db->prepare("
                    INSERT INTO users (nom, prenom, email, password, role_id, enseignant, ban) 
                    VALUES (:nom, :prenom, :email, :password, :role_id, :enseignant, :ban)
                ");
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
                $stmt->bindParam(':role_id', $this->role, PDO::PARAM_INT);
                $stmt->bindParam(':enseignant', $this->enseignant, PDO::PARAM_STR);
                $stmt->bindParam(':ban', $this->ban, PDO::PARAM_STR);
                $stmt->execute();
                $this->id = $db->lastInsertId();
            }
            return $this->id;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("An error occurred while saving the teacher.");
        }
    }

    public static function getTopTeachers()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT users.nom, COUNT(courses.id_course) as courses 
                              FROM users 
                              JOIN courses ON users.id = courses.teacher_id 
                              GROUP BY users.nom 
                              ORDER BY courses DESC 
                              LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setFromDatabase($data)
    {
        parent::setFromDatabase($data);
        $this->enseignant = $data['enseignant'];
    }

    public function isTeacherApproved()
    {
        return $this->role === 2 && $this->enseignant === 'accepted';
    }

    public static function updateEnseignantStatus($id, $status)
    {
        $db = Database::getInstance()->getConnection();
        $query = "UPDATE users SET enseignant = :status WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getPendingEnseignants()
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM users WHERE role_id = 2 AND enseignant = 'waiting'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
