<?php

class Car {
    private $conn;
    private $table = "cars";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua mobil + kategori
    public function getAll() {
        $sql = "SELECT c.id, c.name, c.car_category_id, c.price, c.capacity, d.category_name
                FROM {$this->table} c
                LEFT JOIN car_categories d ON c.car_category_id = d.id
                WHERE c.deleted_at IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua kategori
    public function getCategories() {
        $sql = "SELECT * FROM car_categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah mobil
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                    (name, car_category_id, capacity, price, created_at, updated_at, deleted_at) 
                VALUES(:name, :carCategoryID, :capacity, :price, NOW(), NOW(), NULL)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Ambil detail mobil
    public function find($id) {
        $sql = "SELECT c.id as car_id, c.name, c.car_category_id, c.price, c.capacity, d.category_name 
                FROM {$this->table} c 
                LEFT JOIN car_categories d ON c.car_category_id = d.id 
                WHERE c.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update mobil
    public function update($data) {
        $sql = "UPDATE {$this->table} 
                SET name = :name, 
                    car_category_id = :carCategoryID, 
                    capacity = :capacity, 
                    price = :price, 
                    updated_at = NOW() 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Hapus mobil
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
