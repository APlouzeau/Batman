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
$tasksList = $taskManager->showTasksById($_GET['id']);
$tasksNumber = count($tasksList);

if ($_POST) {
    try {
    foreach ($tasksList as $tasksid) {
        $idTasks[] = $tasksid['id'];
    }
    $taskManager->deleteTasks($idTasks);
} catch (Exception $e) {
    $error = $e->getMessage();
}
    $idEstimate = $_GET['id'];
    /* try {
        $count = count($_POST) / 4;
        for ($i = 0; $i < $count; $i++) {        
            $newTask = new Task([
                'description' => $_POST["description" . $i][0],
                /* 'quantity' => $_POST["quantity" . $i], 
                /* 'unitPrice' => $_POST["unitPrice" . $i] 
            ]);
            $idTask = $taskManager->addTask($newTask);
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
        } 
    } catch (Exception $e) {
        $error = $e->getMessage();
    }*/
}



?>
<div class="container">
    <form method="post">
        <div class="blockList">
        <input type="hidden" id="tasksNumber" value="<?php echo $tasksNumber; ?>">
                <?php
                foreach ($tasksList as $taskDetails) {
                    var_dump( $taskDetails );
                ?>
            <div class="py-2 block<?= $taskDetails['taskNumber']?>" name="lineNb1">
                <label for="description" class="fs-5 fw-bold">Description</label>
                    <textarea rows="2" class="form-control" name="description0[]" required><?= $taskDetails['descriptionTask']?></textarea>
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
                        
                        <tbody class="row<?= $taskDetails['taskNumber']?>">
                        <?php
                            $productsByTask = $taskManager->getProductsByTask($taskDetails['idTask']); //les infos des produits, sans leur identité, mais leur id
                            foreach ($productsByTask as $productByTask) {
                                $testproduct = $productsManager->getProductsById($productByTask['idProduct']);
                                ?>
                            <tr>
                                <td>
                                    <select class="form-select type" id="type" aria-label="Default select example">
                                        <?php foreach ($typesList as $type) { ?>
                                            <option class="" value="<?= $type->getName() ?>"
                                            <?php 
                                            if ($type->getName() == $testproduct->getType()) {
                                                echo 'selected';} ?>><?= $type->getName() ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select product" id="product" aria-label="Default select example" name="product0[]">
                                        <?php foreach ($productList as $type => $product) { ?>
                                            <option class="<?= $product->getType() ?>" value="<?= $product->getName() ?>"
                                            <?php 
                                            if ($product->getName() == $testproduct->getName()) {
                                                echo 'selected';} ?>><?= $product->getName() ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control quantity" id="quantity" name="quantity0[]" type="number" value="<?= $productByTask['quantityProduct'] ?>" required>
                                </td>
                                <td>
                                    <input class="form-control unitPrice" name="unitPrice0[]" type="number" step="any" id="unitPrice" value="<?= $productByTask['unitPriceProduct'] ?>" required>
                                </td>
                                <td>
                                    <div type="number" step="any" data-type="currency" class="resultPrice1"></div>
                                </td>
                            </tr>
                            <?php    
                        }     
                        ?> 
                        </tbody>
                        </table>
                <input type="button" class="btn btn-success addLineBlock<?= $taskDetails['taskNumber']?>" value="Ajouter ligne" id="addLineBlock<?= $taskDetails['taskNumber']?>" onclick="addLine('.rowModel', <?= $taskDetails['taskNumber'] ?>)"/>
                <hr class="border border-primary border-1 opacity-100">
            </div>
            <?php
                }
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