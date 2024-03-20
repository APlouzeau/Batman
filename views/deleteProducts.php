<?php
define("BASE_URL", "/EYOSOP");
require_once "./head.php";
?>

<title>Suppression rouleau</title>

<?php
require_once "./header.php";
require_once "../controller/productsManager.php";

$productsManager = new ProductsManager();
$productsManager->deleteProducts($_GET["id"]);
header("Location:products.php");
?>


<?php
require_once "../views/footer.php";
