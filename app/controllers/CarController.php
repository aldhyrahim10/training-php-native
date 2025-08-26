<?php

require_once __DIR__ . "/../config/database.php";

class CarController {
    
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function index() {
        $sql = "
            SELECT c.id, c.name, c.car_category_id, c.price, c.capacity, d.category_name
            FROM cars c
            LEFT JOIN car_categories d ON c.car_category_id = d.id
            WHERE c.deleted_at IS NULL
        ";

        $sql2 = "
              SELECT * FROM car_categories
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute();

        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $title = "List Car";
        $view  = "car"; // ini halaman yang mau dimuat
        include __DIR__ . '/../../resources/layouts/main.php';
    }

    public function store() {
        $name = $_POST['name'] ?? null;
        $carCategoryID = $_POST['car_category_id'] ?? null;
        $capacity = $_POST['capacity'] ?? null;
        $price = $_POST['price'] ?? null;

        // Cek kalau ada data kosong
        if (empty($name) || empty($carCategoryID) || empty($capacity) || empty($price)) {
            echo json_encode([
                "status" => "error",
                "message" => "Ada data yang kosong"
            ]);
            return;
        }

        try {
            $stmt = $this->conn->prepare("
                INSERT INTO cars (name, car_category_id, capacity, price, created_at, updated_at, deleted_at) 
                VALUES(:name, :carCategoryID , :capacity, :price, NOW(), NOW(), NULL);
            ");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':carCategoryID', $carCategoryID);
            $stmt->bindParam(':capacity', $capacity);
            $stmt->bindParam(':price', $price);
            $stmt->execute();

            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil ditambahkan"
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal menyimpan data: " . $e->getMessage()
            ]);
        }
    }

    public function show() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
            return;
        }

        $sql = "SELECT c.id as car_id, c.name, c.car_category_id, c.price, c.capacity, d.category_name FROM cars c LEFT JOIN car_categories d ON c.car_category_id = d.id WHERE c.id = :id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $dataCar = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataCar) {
            echo json_encode(["status" => "success", "data" => $dataCar]);
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
        }
    }

    public function update() {
        $id = $_POST['hdnCarID'] ?? null;
        $name = $_POST['name'] ?? null;
        $carCategoryID = $_POST['car_category_id'] ?? null;
        $capacity = $_POST['capacity'] ?? null;
        $price = $_POST['price'] ?? null;

        // Validasi input
        if (empty($id) || empty($name) || empty($carCategoryID) || empty($capacity) || empty($price)) {
            echo json_encode([
                "status" => "error", 
                "message" => "Data tidak lengkap"
            ]);
            return;
        }

        try {
            $sql = "UPDATE cars 
                    SET name = :name, 
                        car_category_id = :carCategoryID, 
                        capacity = :capacity, 
                        price = :price, 
                        updated_at = NOW() 
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':carCategoryID', $carCategoryID, PDO::PARAM_INT);
            $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price);
            $stmt->execute();

            echo json_encode([
                "status" => "success", 
                "message" => "Data mobil berhasil diupdate"
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                "status" => "error", 
                "message" => "Gagal update data: " . $e->getMessage()
            ]);
        }
    }

    public function delete($id) {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID not found']);
            return;
        }

        $stmt = $this->conn->prepare("DELETE FROM cars WHERE id = ?");
        $result = $stmt->execute([$id]);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
        }
    }

}
