<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<div class="container">
    <h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
    <input type="hidden" id="taskQuantity" value="<?= count($tasksList) ?>">
    <input type="hidden" id="rowCount" value="<?= $rowCount ?>">
    <form method="post" action="<?= BASE_URL . 'modifyEstimate'; ?>">
        <input type="hidden" id="controlUpdate" name="controlUpdate" value="update">
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId() ?>">
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="blockList">
            <?php
            if (!empty($tasksList)) {

                foreach ($tasksList as $taskDetails) {
            ?>
                    <div class="py-2 blockId block<?= $taskDetails['taskNumber'] ?>" name="lineNb<?= $taskDetails['taskNumber'] ?>" id="block<?= $taskDetails['taskNumber'] ?>">
                        <input type="hidden" class="blocNb" name="taskNumber<?= $taskDetails['taskNumber'] ?>" value="<?= $taskDetails['taskNumber'] ?>">
                        <div class="d-flex justify-content-between">
                            <label for="description" class="fs-5 fw-bold">Description</label>
                            <div class="removeBlock"><i class="fa-solid fa-trash"></i></div>
                        </div>
                        <textarea rows="2" class="form-control description" name="description<?= $taskDetails['taskNumber'] ?>"><?= $taskDetails['descriptionTask'] ?></textarea>
                        <div class="table-responsive">
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

                                <tbody class="task<?= $taskDetails['taskNumber'] ?> table-group-divider">
                                    <?php
                                    $productsByTask = $taskManager->getProductsByTask($taskDetails['id']);
                                    foreach ($productsByTask as $productByTask) {
                                        $infoProducts = $productsManager->getProductsById($productByTask->getIdProduct());
                                    ?>
                                        <tr class="rowId row<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>" id="<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>">
                                            <input type="hidden" class="rowNb" name="row<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getRow() ?>">
                                            <td>
                                                <select class="form-select type" id="type" aria-label="Default select example" style="min-width: 140px">
                                                    <option class="active">SELECTION</option>
                                                    <?php foreach ($typesList as $type) { ?>
                                                        <option class="" data-setType="<?= $type->getId() ?>" value="<?= $type->getName() ?>" <?php
                                                                                                                                                if ($type->getId() == $infoProducts->getType()) {
                                                                                                                                                    echo 'selected';
                                                                                                                                                } ?>><?= $type->getName() ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select product" style="min-width: 150px;" aria-label="Default select example" name="product<?= $taskDetails['taskNumber'] ?>[]">
                                                    <option class="active">SELECTION</option>
                                                    <?php
                                                    foreach ($productList as $type => $product) {
                                                    ?>
                                                        <option hidden class="<?= $product->getType() ?>" data-getType="<?= $product->getType() ?>" data-getUnit="<?= $product->getUnit() ?>" data-getPrice="<?= $product->getPrice() ?>" value="<?= $product->getName() ?>" <?php
                                                                                                                                                                                                                                                                                if ($product->getName() == $infoProducts->getName()) {
                                                                                                                                                                                                                                                                                    echo 'selected';
                                                                                                                                                                                                                                                                                } ?>><?= $product->getName() ?>
                                                        </option>

                                                    <?php

                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code unit"><?= $productByTask->getUnit() ?></span>
                                                    <input type="hidden" class="unitName" name="unit<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getUnit() ?>">
                                                    <input class="form-control quantity text-center" style="min-width: 100px" step="0.001" name="quantity<?= $taskDetails['taskNumber'] ?>[]" type="number" onkeydown="return event.keyCode !== 69" value="<?= $productByTask->getQuantityProduct() ?>" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code">€</span>
                                                    <input class="form-control unitPrice text-center" style="min-width: 100px" step="0.001" name="unitPrice<?= $taskDetails['taskNumber'] ?>[]" type="number" onkeydown="return event.keyCode !== 69" step="any" id="unitPrice" value="<?= $productByTask->getUnitPriceProduct() ?>" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="currency-wrap">
                                                    <span class="currency-code">€</span>
                                                    <div type="number" onkeydown="return event.keyCode !== 69" step="any" style="min-width: 100px;" data-type="currency" class="resultPrice text-center"><?= $productByTask->getQuantityProduct() * $productByTask->getUnitPriceProduct() ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="remove"><i class="fa-solid fa-trash"></i></div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input type=" button" class="btn btn-success addLineBlock<?= $taskDetails['taskNumber'] ?>" value="Ajouter ligne" id="addLineBlock<?= $taskDetails['taskNumber'] ?>" onclick="addLine('.row', <?= $taskDetails['taskNumber'] ?>)" />
                        <hr class="border border-primary border-1 opacity-100">
                    </div>
            <?php
                }
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
<script src="../js/createEstimateScript.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
?>