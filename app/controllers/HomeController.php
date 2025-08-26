<?php

class HomeController {
    public function index() {
        $title = "Dashboard";
        $view  = "dashboard"; // ini halaman yang mau dimuat
        include __DIR__ . '/../../resources/layouts/main.php';
    }
}
