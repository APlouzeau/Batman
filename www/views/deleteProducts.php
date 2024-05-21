<?php
require_once APP_PATH . "/./head.php";
?>

<title>Suppression rouleau</title>

<?php
require_once APP_PATH . "/./header.php";
require_once APP_PATH . "/../controller/productsManager.php";

$productsManager = new ProductsManager();
$productsManager->deleteProducts($_GET["id"]);
header("Location:products.php");
?>


<?php
require_once APP_PATH . "/../views/footer.php";
