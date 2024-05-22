<title>Edition devis</title>

<div class="container">
    <form method="post">
        <div class="blockList">
            <input type="hidden" id="tasksNumber" value="<?php echo $tasksNumber; ?>">
            <?php
            foreach ($tasksList as $taskDetails) {
            ?>
                <div class="py-2 block<?= $taskDetails['taskNumber'] ?>" name="lineNb1">
                    <label for="description" class="fs-5 fw-bold">Description</label>
                    <textarea rows="2" class="form-control" name="description0[]" required><?= $taskDetails['descriptionTask'] ?></textarea>
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

                        <tbody class="row<?= $taskDetails['taskNumber'] ?>">
                            <?php
                            $productsByTask = $taskManager->getProductsByTask($taskDetails['idTask']); //les infos des produits, sans leur identité, mais leur id
                            foreach ($productsByTask as $productByTask) {
                                $testproduct = $productsManager->getProductsById($productByTask['idProduct']);
                            ?>
                                <tr>
                                    <td>
                                        <select class="form-select type" id="type" aria-label="Default select example">
                                            <?php foreach ($typesList as $type) { ?>
                                                <option class="" value="<?= $type->getName() ?>" <?php
                                                                                                    if ($type->getName() == $testproduct->getType()) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $type->getName() ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select product" id="product" aria-label="Default select example" name="product0[]">
                                            <?php foreach ($productList as $type => $product) { ?>
                                                <option class="<?= $product->getType() ?>" value="<?= $product->getName() ?>" <?php
                                                                                                                                if ($product->getName() == $testproduct->getName()) {
                                                                                                                                    echo 'selected';
                                                                                                                                } ?>><?= $product->getName() ?></option>
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
                    <input type="button" class="btn btn-success addLineBlock<?= $taskDetails['taskNumber'] ?>" value="Ajouter ligne" id="addLineBlock<?= $taskDetails['taskNumber'] ?>" onclick="addLine('.rowModel', <?= $taskDetails['taskNumber'] ?>)" />
                    <hr class="border border-primary border-1 opacity-100">
                </div>
            <?php
            }
            require_once APP_PATH . "/views/blockModel.php";
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
require_once APP_PATH . "/../views/footer.php";
?>