<?php

require_once __DIR__ . "/../config/database.php";

class CarCategoryController {
    
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function index() {
        $sql = "
              SELECT * FROM car_categories
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();


        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $title = "List Car Category";
        $view  = "car-category";
        include __DIR__ . '/../../resources/layouts/main.php';
    }

    public function store() {
        $categoryName = $_POST['category_name'] ?? null;

        if ($categoryName) {
            $stmt = $this->conn->prepare("INSERT INTO car_categories (category_name) VALUES (:name)");
            $stmt->bindParam(':name', $categoryName);
            $stmt->execute();

            // return JSON ke AJAX
            echo json_encode([
                "status" => "success",
                "message" => "Kategori berhasil ditambahkan",
                "data" => [
                    "id" => $this->conn->lastInsertId(),
                    "category_name" => $categoryName
                ]
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Nama kategori wajib diisi"
            ]);
        }
    }

    public function show() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
            return;
        }

        $sql = "SELECT * FROM car_categories WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            echo json_encode(["status" => "success", "data" => $category]);
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak ditemukan"]);
        }
    }


    public function update() {
        $id = $_POST['hdnCategoryID'] ?? null;
        $name = $_POST['category_name'] ?? null;

        if (!$id || !$name) {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
            return;
        }

        $stmt = $this->conn->prepare("UPDATE car_categories SET category_name = :name WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(["status" => "success", "message" => "Kategori berhasil diupdate"]);
    }


    public function delete($id) {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID not found']);
            return;
        }

        $stmt = $this->conn->prepare("DELETE FROM car_categories WHERE id = ?");
        $result = $stmt->execute([$id]);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
        }
    }

}