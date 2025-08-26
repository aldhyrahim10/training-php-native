<?php

require_once __DIR__ . "/../models/Car.php";

class CarController {
    private $carModel;

    public function __construct($db) {
        $this->carModel = new Car($db);
    }

    public function index() {
        $cars       = $this->carModel->getAll();
        $categories = $this->carModel->getCategories();

        $title = "List Car";
        $view  = "car";
        include __DIR__ . '/../../resources/layouts/main.php';
    }

    public function store() {
        $data = [
            ':name'         => $_POST['name'] ?? null,
            ':carCategoryID'=> $_POST['car_category_id'] ?? null,
            ':capacity'     => $_POST['capacity'] ?? null,
            ':price'        => $_POST['price'] ?? null
        ];

        if (in_array(null, $data, true)) {
            echo json_encode(["status" => "error", "message" => "Ada data yang kosong"]);
            return;
        }

        $success = $this->carModel->create($data);
        echo json_encode([
            "status"  => $success ? "success" : "error",
            "message" => $success ? "Data berhasil ditambahkan" : "Gagal menyimpan data"
        ]);
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
            return;
        }

        $dataCar = $this->carModel->find($id);
        echo json_encode($dataCar 
            ? ["status" => "success", "data" => $dataCar]
            : ["status" => "error", "message" => "Data tidak ditemukan"]
        );
    }

    public function update() {
        $data = [
            ':id'           => $_POST['hdnCarID'] ?? null,
            ':name'         => $_POST['name'] ?? null,
            ':carCategoryID'=> $_POST['car_category_id'] ?? null,
            ':capacity'     => $_POST['capacity'] ?? null,
            ':price'        => $_POST['price'] ?? null
        ];

        if (in_array(null, $data, true)) {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
            return;
        }

        $success = $this->carModel->update($data);
        echo json_encode([
            "status"  => $success ? "success" : "error",
            "message" => $success ? "Data mobil berhasil diupdate" : "Gagal update data"
        ]);
    }

    public function delete($id) {
        $success = $this->carModel->delete($id);
        echo json_encode([
            "status"  => $success ? "success" : "error",
            "message" => $success ? "Data berhasil dihapus" : "Delete failed"
        ]);
    }
}
