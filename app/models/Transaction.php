<?php

class Transaction {
    private $conn;
    private $table = "transactions";

    public $id;
    public $customer_name;
    public $car_id;
    public $days;
    public $total_price;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua transaksi dengan join mobil
    public function all() {
        $sql = "
            SELECT 
                a.id AS transaction_id, 
                a.customer_name, 
                a.car_id, 
                b.name AS car_name,  
                a.days, 
                a.total_price, 
                a.created_at, 
                a.updated_at, 
                a.deleted_at
            FROM {$this->table} a
            LEFT JOIN cars b ON a.car_id = b.id
            WHERE a.deleted_at IS NULL
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cari transaksi berdasarkan ID
    public function find($id) {
        $sql = "
            SELECT 
                a.id AS transaction_id, 
                a.customer_name, 
                a.car_id, 
                b.name AS car_name,  
                a.days, 
                a.total_price, 
                a.created_at, 
                a.updated_at, 
                a.deleted_at
            FROM {$this->table} a
            LEFT JOIN cars b ON a.car_id = b.id
            WHERE a.id = :id AND a.deleted_at IS NULL
            LIMIT 1
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Transaction.php (model)
    public function create($customerName, $carId, $days, $totalPrice) {
        $sql = "INSERT INTO transactions 
                    (customer_name, car_id, days, total_price, created_at, updated_at, deleted_at) 
                VALUES 
                    (:customerName, :carId, :days, :totalPrice, NOW(), NOW(), NULL)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':customerName', $customerName);
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->bindParam(':days', $days, PDO::PARAM_INT);
        $stmt->bindParam(':totalPrice', $totalPrice);
        return $stmt->execute();
    }

    public function getCarPrice($carId) {
        $stmt = $this->conn->prepare("SELECT price FROM cars WHERE id = :carId LIMIT 1");
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}