<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
?>

<title>Accueil</title>

<?php
require_once "../views/header.php";
require_once "../controller/estimateManager.php";
require_once "../controller/productsManager.php";
require_once "../controller/typesManager.php";
require_once "../models/estimateModel.php";

$estimateManager = new EstimateManager();
$productsManager = new ProductsManager;
$productList = $productsManager->showProducts();
$typesManager = new TypesManager();
$typesList = $typesManager->showTypes();

if ($_POST) {
    $ressources = $_POST["quantity"];
    try {
        $newEstimate = new Estimate([
            "ressources" => $ressources
        ]);
        $estimateManager->createEstimate($newEstimate);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>



<?php
require_once "../views/footer.php";
?>