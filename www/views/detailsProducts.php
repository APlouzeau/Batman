<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
require_once "../controller/productsManager.php";
$productsManager = new ProductsManager();
$roll = $productsManager->getProductsById($_GET["id"]);

?>

<title><?= $roll->getName() ?></title>

<?php
require_once "../views/header.php";
?>

<div class="container">
    <h2 class="text-center"><?= $roll->getName() ?></h2>
    <h4>Description</h4>
    <p><?= $roll->getDescription() ?></p>
    <h5>Recouvrement</h5>
    <p><?= $roll->getRecovery() ?> mm</p>
    <h5>Prix</h5>
    <p><?= $roll->getPrice() ?> €/m²</p>
</div>

<?php
require_once "../views/footer.php";
?>