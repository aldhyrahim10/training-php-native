    <?php
    // load config (opsional, kalau ada file database.php, constant, dsb)
    require_once __DIR__ . '/app/config/database.php';

    // Tentukan halaman default
    $page = $_GET['page'] ?? 'dashboard';


    // Routing sederhana
    switch ($page) {
        case 'dashboard':
            require_once __DIR__ . '/app/controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            break;

        case 'car':
            require_once __DIR__ . '/app/controllers/CarController.php';
            $controller = new CarController($db);

            $action = $_GET['action'] ?? null;

            if ($action === 'show') {
                $id = $_GET['id'] ?? null;
                $controller->show($id);

            } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update();

            } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? null;
                $controller->delete($id);

            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();

            } else {
                $controller->index();
            }
            break;

        case 'car-category':
            require_once __DIR__ . '/app/controllers/CarCategoryController.php';
            $controller = new CarCategoryController($db);

            $action = $_GET['action'] ?? null;

            if ($action === 'show') {
                $id = $_GET['id'] ?? null;
                $controller->show($id);

            } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update();

            } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? null;
                $controller->delete($id);

            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // default kalau POST tapi bukan update/delete → berarti tambah baru
                $controller->store();

            } else {
                $controller->index();
            }
            break;


        case 'transaction':
            require_once __DIR__ . '/app/controllers/TransactionController.php';
            $controller = new TransactionController($db);
            $action = $_GET['action'] ?? null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // default kalau POST tapi bukan update/delete → berarti tambah baru
                $controller->store();

            } else {
                $controller->index();
            }
            break;

        default:
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            break;
    }