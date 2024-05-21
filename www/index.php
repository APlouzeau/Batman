<?php
define("APP_PATH", __DIR__);
define("BASE_URL", "/");
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/models/router.php";
require_once APP_PATH . "/controller/userController.php";
require_once APP_PATH . "/controller/estimateController.php";
require_once APP_PATH . "/controller/customerController.php";
require_once APP_PATH . "/controller/homeController.php";
?>

<title>Accueil</title>

<?php
require_once APP_PATH . "/views/header.php";

$router = new Router();
// $method, $path, $controller, $action

//routes connection
$router->addRoute('GET', BASE_URL, 'userController', 'formConnectUser');
$router->addRoute('POST', BASE_URL, 'userController', 'connectUserController');
$router->addRoute('GET', BASE_URL . 'logout', 'userController', 'disconnect');

// routes estimate
$router->addRoute('GET', BASE_URL . 'estimate', 'estimateController', 'estimate');
$router->addRoute('GET', BASE_URL . 'searchCustomer', 'customerController', 'searchCustomer');
$router->addRoute('GET', BASE_URL . 'newEstimate', 'estimateController', 'newEstimatePage');
$router->addRoute('POST', BASE_URL . 'createEstimate', 'estimateController', 'newEstimate');

//routes profile
$router->addRoute('GET', BASE_URL . 'profile', 'userController', 'profile');
$router->addRoute('GET', BASE_URL . 'updateProfile', 'userController', 'updateProfilePage');
$router->addRoute('POST', BASE_URL . 'updateProfile', 'userController', 'updateProfile');
$router->addRoute('GET', BASE_URL . 'updatePassword', 'userController', 'updatePasswordPage');
$router->addRoute('POST', BASE_URL . 'updatePassword', 'userController', 'updatePassword');

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$handler = $router->getHandler($method, $uri);
var_dump($handler);
$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action();

require_once APP_PATH . "/views/footer.php";
