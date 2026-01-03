<?php
require_once "./core/Database.php";

class Assurance {
    private $db;

    public function __construct(){
        $this->db = (new Database())->conn;
    }

    public function all() {
        $stmt = $this->db->query("
            SELECT assurance.id, assurance.client, assurance.periode, assurance.prime, type_assurance.label
            FROM assurance
            JOIN type_assurance ON assurance.type_assurance_id = type_assurance.id
            ORDER BY assurance.id DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM assurance WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO assurance (client, periode, prime, type_assurance_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['client'], $data['periode'], $data['prime'], $data['type_assurance_id']]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare("UPDATE assurance SET client=?, periode=?, prime=?, type_assurance_id=? WHERE id=?");
        return $stmt->execute([$data['client'], $data['periode'], $data['prime'], $data['type_assurance_id'], $id]);
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM assurance WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getTypes(){
        $stmt = $this->db->query("SELECT id, label FROM type_assurance ORDER BY label ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
