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
                    <select class="form-select type" id="type" aria-label="Default select example">
                        <?php foreach ($typesList as $type) { ?>
                            <option class="" value="<?= $type->getName() ?>"><?= $type->getName() ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select class="form-select product" id="product" aria-label="Default select example">
                        <?php foreach ($productList as $type => $product) { ?>
                            <option class="<?= $product->getType() ?>" value="<?= $product->getPrice() ?>"><?= $product->getName() ?></option>
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
                </td>
            </tr>
        </table>
        <input type="button" class="btn btn-success" value="Ajouter" id="addLine" />
    </form>
    <h5 class="resultPriceTotal"></h5>
</div>
<script src="../JS/createEstimateScript.js"></script>
<?php
require_once "../views/footer.php";
?>