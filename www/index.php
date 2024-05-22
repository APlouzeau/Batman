<?php
define("APP_PATH", __DIR__);
define("BASE_URL", "/");
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/models/router.php";
require_once APP_PATH . "/controller/userController.php";
require_once APP_PATH . "/controller/estimateController.php";
require_once APP_PATH . "/controller/customerController.php";
require_once APP_PATH . "/controller/homeController.php";
require_once APP_PATH . "/controller/productController.php";
?>

<title>Accueil</title>

<?php
require_once APP_PATH . "/views/header.php";

$router = new Router();
// $method, $path, $controller, $action

//routes connection
$router->addRoute('GET', BASE_URL, 'UserController', 'formConnectUser');
$router->addRoute('POST', BASE_URL, 'UserController', 'connectUserController');
$router->addRoute('GET', BASE_URL . 'logout', 'UserController', 'disconnect');

// routes estimate
$router->addRoute('POST', BASE_URL . 'addCustomer', 'customerController', 'addCustomer');
$router->addRoute('GET', BASE_URL . 'searchCustomer', 'customerController', 'searchCustomer');
$router->addRoute('GET', BASE_URL . 'estimate', 'EstimateController', 'estimate');
$router->addRoute('GET', BASE_URL . 'newEstimate', 'EstimateController', 'newEstimatePage');
$router->addRoute('POST', BASE_URL . 'createEstimate', 'EstimateController', 'newEstimate');
$router->addRoute('GET', BASE_URL . 'searchEstimate', 'EstimateController', 'searchEstimate');
$router->addRoute('GET', BASE_URL . 'modifyEstimate', 'EstimateController', 'modifyEstimate');
$router->addRoute('POST', BASE_URL . 'registerEstimate', 'EstimateController', 'registerEstimate');

//routes profile
$router->addRoute('GET', BASE_URL . 'profile', 'UserController', 'profile');
$router->addRoute('GET', BASE_URL . 'updateProfile', 'UserController', 'updateProfilePage');
$router->addRoute('POST', BASE_URL . 'updateProfile', 'UserController', 'updateProfile');
$router->addRoute('GET', BASE_URL . 'updatePassword', 'UserController', 'updatePasswordPage');
$router->addRoute('POST', BASE_URL . 'updatePassword', 'UserController', 'updatePassword');
$router->addRoute('GET', BASE_URL . 'usersAccount', 'UserController', 'usersAccountPage');
$router->addRoute('POST', BASE_URL . 'addUser', 'UserController', 'addUser');

//routes products
$router->addRoute('GET', BASE_URL . 'products', 'ProductController', 'products');
$router->addRoute('GET', BASE_URL . 'details', 'ProductController', 'details');
$router->addRoute('GET', BASE_URL . 'modify', 'ProductController', 'modifyProductPage');
$router->addRoute('POST', BASE_URL . 'modify', 'ProductController', 'modifyProduct');
$router->addRoute('GET', BASE_URL . 'delete', 'ProductController', 'deleteProduct');
$router->addRoute('POST', BASE_URL . 'create', 'ProductController', 'createProduct');


$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$handler = $router->getHandler($method, $uri);
var_dump($handler);
var_dump($method);
var_dump($uri);
$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action();

require_once APP_PATH . "/views/footer.php";
