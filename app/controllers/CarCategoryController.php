<?php

require_once __DIR__ . "/../models/CarCategory.php";

class CarCategoryController {
    
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new CarCategory($db);
    }

    public function index() {
        $categories = $this->categoryModel->all();
        $title = "List Car Category";
        $view  = "car-category";
        include __DIR__ . '/../../resources/layouts/main.php';
    }

    public function store() {
        $categoryName = $_POST['category_name'] ?? null;

        if ($categoryName) {
            $id = $this->categoryModel->create($categoryName);

            echo json_encode([
                "status" => "success",
                "message" => "Kategori berhasil ditambahkan",
                "data" => [
                    "id" => $id,
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

        $category = $this->categoryModel->find($id);

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

        $this->categoryModel->update($id, $name);
        echo json_encode(["status" => "success", "message" => "Kategori berhasil diupdate"]);
    }

    public function delete($id) {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID not found']);
            return;
        }

        if ($this->categoryModel->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
        }
    }
}
