<title>Edition devis</title>

<div class="container">
    <h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
    <input type="hidden" id="taskQuantity" value="<?= count($tasksList) ?>">
    <input type="hidden" id="rowCount" value="<?= $rowCount ?>">
    <form method="post" action="<?= BASE_URL . 'modifyEstimate'; ?>">
        <input type="hidden" id="controlUpdate" name="controlUpdate" value="update">
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId() ?>">
        <div class="blockList">
            <?php
            foreach ($tasksList as $taskDetails) {
            ?>
                <div class="py-2 block<?= $taskDetails['taskNumber'] ?>" name="lineNb<?= $taskDetails['taskNumber'] ?>">
                    <input type="hidden" class="blocNb" name="taskNumber<?= $taskDetails['taskNumber'] ?>" value="<?= $taskDetails['taskNumber'] ?>">
                    <label for="description" class="fs-5 fw-bold">Description</label>
                    <textarea rows="2" class="form-control description" name="description<?= $taskDetails['taskNumber'] ?>"><?= $taskDetails['descriptionTask'] ?></textarea>
                    <table class="text-center table table<?= $taskDetails['taskNumber'] ?> table-striped">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Montant total</th>
                            </tr>
                        </thead>

                        <tbody class="task<?= $taskDetails['taskNumber'] ?>">
                            <?php
                            $productsByTask = $taskManager->getProductsByTask($taskDetails['id']); //les infos des produits, sans leur identité, mais leur id
                            foreach ($productsByTask as $productByTask) {
                                $testproduct = $productsManager->getProductsById($productByTask['idProduct']);
                            ?>
                                <tr class="rowId row<?= $taskDetails['taskNumber'] . $productByTask['row'] ?>" id="<?= $taskDetails['taskNumber'] . $productByTask['row'] ?>">
                                    <input type="hidden" class="rowNb" name="row<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask['row'] ?>">
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
                                        <select class="form-select product" id="product" aria-label="Default select example" name="product<?= $taskDetails['taskNumber'] ?>[]">
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
                                        <input class="form-control quantity" id="quantity" name="quantity<?= $taskDetails['taskNumber'] ?>[]" type="number" value="<?= $productByTask['quantityProduct'] ?>" required>
                                    </td>
                                    <td>
                                        <input class="form-control unitPrice" name="unitPrice<?= $taskDetails['taskNumber'] ?>[]" type="number" step="any" id="unitPrice" value="<?= $productByTask['unitPriceProduct'] ?>" required>
                                    </td>
                                    <td>
                                        <div type="number" step="any" data-type="currency" class="resultPrice"><?= $productByTask['quantityProduct'] * $productByTask['unitPriceProduct'] ?></div>
                                    </td>
                                    <td>
                                        <div class="remove">X</div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <input type=" button" class="btn btn-success addLineBlock<?= $taskDetails['taskNumber'] ?>" value="Ajouter ligne" id="addLineBlock<?= $taskDetails['taskNumber'] ?>" onclick="addLine('.row', <?= $taskDetails['taskNumber'] ?>)" />
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
require_once APP_PATH . "/views/footer.php";
?>