<?php
require_once __DIR__ . '/Database.php';

class UserModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function authenticate($login, $password) {
        $sql = "SELECT * FROM utilisateurs WHERE login = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            if ($password == $row['password']) {
                return $row;
            }
        }
        return false;
    }

    public function getUserByLogin($login) {
        $sql = "SELECT * FROM utilisateurs WHERE login = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
    public function createUser($userData, $profilePicturePath) {
        $sql = "INSERT INTO utilisateurs (nom, prenom, telephone, adresse, role, login, password, pp) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssisss",
            $userData['nom'],
            $userData['prenom'],
            $userData['telephone'],
            $userData['adresse'],
            $userData['role'],
            $userData['login'],
            $userData['password'],
            $profilePicturePath
        );
        return mysqli_stmt_execute($stmt);
    }

    public function checkLoginExists($login) {
        $sql = "SELECT id FROM utilisateurs WHERE login = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $login);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;
    }

    public function uploadProfilePicture($file) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        if ($file['error'] === 0) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $extension;
            $destination = $upload_dir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                return $destination;
            }
        }
        return false;
    }
}