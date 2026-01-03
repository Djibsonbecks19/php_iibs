<?php
require_once "./core/Database.php";

class TypeAssurance {
    private $db;

    public function __construct(){
        $this->db = (new Database())->conn;
    }

    public function all() {
        $stmt = $this->db->query("SELECT id, label FROM type_assurance ORDER BY label ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM type_assurance WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO type_assurance (label) VALUES (?)");
        return $stmt->execute([$data['label']]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare("UPDATE type_assurance SET label=? WHERE id=?");
        return $stmt->execute([$data['label'], $id]);
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM type_assurance WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
