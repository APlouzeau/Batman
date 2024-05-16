<?php
require_once "../views/head.php";
?>

<title>Edition devis</title>

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
$tasksNumber = 1;
var_dump($_POST);

if ($_POST) {     
    $idEstimate = $_GET['id'];  
    try {
        $count = floor(count($_POST) / 4);
        for ($i = 0; $i < $count; $i++) {       
            $newTask = new Task([
                'taskNumber' => $_POST['taskNumber' . $i][0],
                'descriptionTask' => $_POST["description" . $i][0],
                /* 'quantity' => $_POST["quantity" . $i], 
                'unitPrice' => $_POST["unitPrice" . $i]  */
            ]);
            $idTask = $taskManager->addTask($newTask);
            $taskManager->addTaskRef($idEstimate, $idTask);
            $j = 0;
            foreach ($_POST['product' . $i] as $value) {
                $product = $productsManager->getProductsByName($_POST['product' . $i][$j]);
                $newProducts = new Products([
                    'id' => $product->getId()
                ]);
                $newProductByTask = new ProductByTask([
                    'quantityProduct' => $_POST['quantity' .$i][$j],
                    'unitPriceProduct' => $_POST['unitPrice' .$i][$j],
                ]);
                $taskManager->addProductByTask($idTask, $newProductByTask, $newProducts);
                $j++;   
            }
        } /* header("Location:modifyEstimate.php?id=$estimateId"); */
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
} 

/* $j = 0;
foreach ($_POST['product' . $i] as $key => $value) {
    $newProductByTask = new ProductByTask([
        'idProductByTask' => '2',
        'idProduct' => '3',
        'idTask' => '4',
        'quantityProduct' => $_POST["quantity" . $i][$j],
        'unitPriceProduct' => $_POST["unitPrice" . $i][$j]
    ]);
}  */
?>
<div class="container">
    <form method="post">
        <div class="blockList">
        <input type="hidden" id="tasksNumber" value="1">
            <div class="py-2 block0" id="block0">
                <input type="hidden" name="taskNumber0[]" value="0">
                <label for="description" class="fs-5 fw-bold">Description</label>
                    <textarea rows="2" class="form-control" name="description0[]" required></textarea>
                    <table class="text-center table table-striped task1">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Montant total</th>
                            </tr>
                        </thead>

                        <tbody class="row0">
                            <tr>
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
                                    <select class="form-select product" id="product" aria-label="Default select example" name="product0[]">
                                        <?php foreach ($productList as $type => $product) { ?>
                                            <option class="<?= $product->getType() ?>" value="<?= $product->getName() ?>"><?= $product->getName() ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control quantity" id="quantity" name="quantity0[]" type="number" required>
                                </td>
                                <td>
                                    <input class="form-control unitPrice" name="unitPrice0[]" type="number" step="any" id="unitPrice" value="" required>
                                </td>
                                <td>
                                    <div type="number" step="any" data-type="currency" class="resultPrice1"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <input type="button" class="btn btn-success addLineBlock1" value="Ajouter ligne" id="addLineBlock1" onclick="addLine('.rowModel', 0)"/>
                <hr class="border border-primary border-1 opacity-100">
            </div>
            <?php
            require_once "../views/blockModel.php";
            ?>
        </div>
        <input type="button" class="btn btn-success addBlock" value="Ajouter bloc" />
        <div class="container text-end">
            <input type="submit" value="Enregistrer devis" class="btn btn-primary">
        </div>
    </form>

    <h5 class="resultPriceTotal"></h5>
</div>
<script src="JS/createEstimateScript.js"></script>
<?php
require_once "../views/footer.php";
?>