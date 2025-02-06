<?php
require_once APPROOT . '/libraries/Database.php';

class Users {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $passwordHash;
    protected $role;
    protected $ban;
    protected $enseignant;



    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getEnseignant() { return $this->enseignant; }

    public function __construct($id = null, $nom = null, $prenom = null, $email = null, $role = null, $password = null, $enseignant = 'waiting') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = $role;
        $this->enseignant = $enseignant;
        if ($password !== null) {
            $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        }
    }

    public function __toString() {
        return $this->nom . " " . $this->prenom;
    }

    public static function searchRole($email) {
        $user = self::findByEmail($email);
        if ($user !== null) {
            return $user->getRole();
        }
        return null;
    }

    public static function register($nom, $prenom, $email, $role, $password) {
        $db = Database::getInstance()->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        error_log("Register data: " . json_encode(compact('nom', 'prenom', 'email', 'role', 'password')));

        // Check if email already exists
        if (self::findByEmail($email)) {
            error_log("Email already registered: " . $email);
            throw new Exception("Email is already registered");
        }

        try {
            $stmt = $db->prepare("
            INSERT INTO users (nom, prenom, email, password, role_id, enseignant)
            VALUES (:nom, :prenom, :email, :password, :role_id, :enseignant)
        ");
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $enseignant = 'waiting'; // Set default value for enseignant

            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->bindParam(':role_id', $role, PDO::PARAM_INT);
            $stmt->bindParam(':enseignant', $enseignant, PDO::PARAM_STR);

            if ($stmt->execute()) {
                error_log("User registered successfully: " . $email);
                return true;
            } else {
                error_log("Failed to insert data into the database.");
                throw new Exception("Failed to insert data into the database.");
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function signin($email, $password) {
        $user = self::findByEmail($email);

        if (!$user) {
            throw new Exception("Invalid email or password!");
        }

        if (!password_verify($password, $user->passwordHash)) {
            throw new Exception("Invalid email or password!");
        }

        if ($user->ban === 'true') {
            throw new Exception("This account has been banned!");
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        $_SESSION['nom'] = $user->nom;
        $_SESSION['prenom'] = $user->prenom;

        return $user;
    }

    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT *
            FROM users
            WHERE email = :email
        ");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new self();
        $user->setFromDatabase($data);
        return $user;
    }

    public function setFromDatabase($data) {
        $this->id = $data['id'];
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->email = $data['email'];
        $this->passwordHash = $data['password'];
        $this->role = $data['role_id'];
        $this->ban = $data['ban'];
        $this->enseignant = $data['enseignant'];
    }

    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $query = "
            SELECT *
            FROM users
            ORDER BY created_at DESC
        ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public static function ban($id) {
        $db = Database::getInstance()->getConnection();
        $query = "UPDATE users SET ban = 'true' WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$id]);
    }

    public static function unban($id) {
        $db = Database::getInstance()->getConnection();
        $query = "UPDATE users SET ban = 'false' WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$id]);
    }

    public static function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: ../../index.php");
        exit();
    }
}
?>