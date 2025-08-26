<?php
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Car.php';

class TransactionController {
    private $transactionModel;
    private $carModel;

    public function __construct($db) {
        $this->transactionModel = new Transaction($db);
        $this->carModel         = new Car($db);
    }

    public function index() {
        $transactions = $this->transactionModel->all();
        $cars         = $this->carModel->getAll();

        $title = "List Transaction";
        $view  = "transaction";
        include __DIR__ . '/../../resources/layouts/main.php';
    }


    public function store() {
        $customerName = $_POST['customer_name'] ?? null;
        $carId        = $_POST['car_id'] ?? null;
        $days         = $_POST['days'] ?? null;

        if (empty($customerName) || empty($carId) || empty($days)) {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
            return;
        }

        // ambil harga mobil dari model
        $car = $this->transactionModel->getCarPrice($carId);
        if (!$car) {
            echo json_encode(["status" => "error", "message" => "Mobil tidak ditemukan"]);
            return;
        }

        $total_price = $days * $car['price'];

        // simpan transaksi
        $this->transactionModel->create($customerName, $carId, $days, $total_price);

        echo json_encode([
            "status" => "success",
            "message" => "Transaksi berhasil ditambahkan",
            "total_price" => $total_price
        ]);
    }

}
