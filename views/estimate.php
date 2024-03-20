<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
?>

<title>Accueil</title>

<?php
require_once "../views/header.php";
require_once "../controller/estimateManager.php";
require_once "../controller/productsManager.php";
require_once "../models/estimateModel.php";

$estimateManager = new EstimateManager();
$productsManager = new ProductsManager;
$rollList = $productsManager->showProducts();

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
<div class="container">
    <form method="post">
        <table id="estimate" class="text-center">
            <tr>
                <th>Poste</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Montant total</th>
            </tr>
            <tr id="firstRow">
                <td>
                    <select class="form-select" id="poste" aria-label="Default select example">
                        <option>Etanchéité</option>
                        <option>Zinguerie</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" id="product" aria-label="Default select example">
                        <?php foreach ($rollList as $roll) { ?>
                            <option class="<?= $roll->getName() ?>" value="<?= $roll->getPrice() ?>"><?= $roll->getName() ?></option>
                        <?php
                        }
                        ?>
                    </select>
                <td>
                    <input class="form-control quantity" id="quantity" name="quantity" type="number">
                </td>
                <td>
                    <input class="form-control unitPrice" name="price" type="number" id="unitPrice" value="">
                </td>
                <td>
                    <div class="resultPrice">0</div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" class="btn btn-success" value="Ajouter" id="addLine" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
require_once "../views/footer.php";
?>