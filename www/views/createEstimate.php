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
require_once "../controller/taskManager.php";
require_once "../controller/productByTaskManager.php";
require_once "../models/estimateModel.php";
require_once "../models/taskModel.php";

$estimateManager = new EstimateManager();
$productsManager = new ProductsManager();
$productList = $productsManager->showProducts();
$typesManager = new TypesManager();
$typesList = $typesManager->showTypes();
$taskManager = new TaskManager();
$productByTaskManager = new productByTaskManager();

if ($_POST) {
    var_dump($_POST);
    try {
        $newTask = new Task([
            $lineNb = $_POST["lineNb1"],
            $description = $_POST["description"],
            $quantity = $_POST["quantity"],
            $unitPrice = $_POST["unitPrice"],

        ]);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<div class="container">
    <form method="post">
        <div class="blockList">
            <?php
            require_once "../views/blockModel.php";
            ?>
            <div class="py-2 block1" name="lineNb1">
                <table class="text-center table table-striped task1">
                    <thead>
                        <tr>
                            <th>Poste</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Montant total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr id="row1">
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
                            </td>
                            <td>
                                <input class="form-control quantity" id="quantity" name="quantity" type="number">
                            </td>
                            <td>
                                <input class="form-control unitPrice" name="unitPrice" type="number" step="any" id="unitPrice" value="">
                            </td>
                            <td>
                                <div type="number" step="any" data-type="currency" class="resultPrice1"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="button" class="btn btn-success addLineBlock1" value="Ajouter ligne" id="addLineBlock1" />
                <hr class="border border-primary border-1 opacity-100">
            </div>
        </div>
        <input type="button" class="btn btn-success addBlock" value="Ajouter bloc" />
        <div class="container text-end">
            <input type="submit" value="Enregistrer devis" class="btn btn-primary">
        </div>
    </form>

    <h5 class="resultPriceTotal"></h5>
</div>
<script src="../JS/createEstimateScript.js"></script>
<?php
require_once "../views/footer.php";
?>