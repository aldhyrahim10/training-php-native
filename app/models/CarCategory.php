<?php

class CarCategory {
    private $conn;
    private $table = "car_categories";

    public function __construct($db) {
        $this->conn = $db;
    }

    // ambil semua kategori
    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ambil detail kategori by id
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // tambah kategori
    public function create($name) {
        $sql = "INSERT INTO {$this->table} (category_name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // update kategori
    public function update($id, $name) {
        $sql = "UPDATE {$this->table} SET category_name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // hapus kategori
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
