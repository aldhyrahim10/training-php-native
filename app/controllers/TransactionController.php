<?php

require_once __DIR__ . "/../config/database.php";

class TransactionController {
    
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function index() {
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
            FROM transactions a
            LEFT JOIN cars b ON a.car_id = b.id
            WHERE a.deleted_at IS NULL
        ";

        $sql2 = "
            SELECT c.id, c.name, c.car_category_id, c.price, c.capacity, d.category_name
            FROM cars c
            LEFT JOIN car_categories d ON c.car_category_id = d.id
            WHERE c.deleted_at IS NULL
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute();

        $cars = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $title = "List Transaction";
        $view  = "transaction";
        include __DIR__ . '/../../resources/layouts/main.php';
    }

    public function store() {
        $customerName = $_POST['customer_name'] ?? null;
        $carId        = $_POST['car_id'] ?? null;
        $days         = $_POST['days'] ?? null;

        // Validasi input
        if (empty($customerName) || empty($carId) || empty($days)) {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
            return;
        }

        try {
            // Ambil harga mobil dari tabel cars
            $stmt = $this->conn->prepare("SELECT price FROM cars WHERE id = :carId LIMIT 1");
            $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
            $stmt->execute();
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$car) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Mobil tidak ditemukan"
                ]);
                return;
            }

            $price       = $car['price'];
            $total_price = $days * $price;

            // Simpan transaksi
            $sql = "INSERT INTO transactions 
                        (customer_name, car_id, days, total_price, created_at, updated_at, deleted_at) 
                    VALUES 
                        (:customerName, :carId, :days, :totalPrice, NOW(), NOW(), NULL)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':customerName', $customerName);
            $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
            $stmt->bindParam(':days', $days, PDO::PARAM_INT);
            $stmt->bindParam(':totalPrice', $total_price);
            $stmt->execute();

            echo json_encode([
                "status" => "success",
                "message" => "Transaksi berhasil ditambahkan",
                "total_price" => $total_price
            ]);

        } catch (PDOException $e) {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal menambahkan transaksi: " . $e->getMessage()
            ]);
        }
    }


}
