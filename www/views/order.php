<title>Commande</title>

<title>Situation</title>

<h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
<div class="container ">
    <input type="hidden" id="taskQuantity" value="<?= count($tasksList) ?>">
    <form method="post" action="<?= BASE_URL . 'saveOrder'; ?>">
        <input type="hidden" id="controlUpdate" name="controlUpdate" value="update">
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId() ?>">
        <div class="blockList">
            <?php
            foreach ($tasksList as $taskDetails) {
            ?>
                <div class="py-2 block<?= $taskDetails['taskNumber'] ?>" name="lineNb<?= $taskDetails['taskNumber'] ?>">
                    <input type="hidden" class="blocNb" name="taskId<?= $taskDetails['taskNumber'] ?>" value="<?= $taskDetails['id'] ?>">
                    <label for="description" class="fs-5 fw-bold">Description</label>
                    <textarea rows="2" class="form-control description" name="description<?= $taskDetails['taskNumber'] ?>" disabled><?= $taskDetails['descriptionTask'] ?></textarea>
                    <div class="table-responsive">
                        <table class="text-center table table<?= $taskDetails['taskNumber'] ?> table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Produit</th>
                                    <th>Montant dépensé</th>
                                    <th>Montant vendu</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Montant de commande</th>
                                </tr>
                            </thead>
                            <tbody class="task<?= $taskDetails['taskNumber'] ?>">
                                <?php
                                $productsByTask = $taskManager->getProductsByTask($taskDetails['id']); //les infos des produits, sans leur identité, mais leur id
                                foreach ($productsByTask as $productByTask) {
                                    $testproduct = $productsManager->getProductsById($productByTask->getIdProduct());
                                ?>
                                    <tr class="rowId row<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>" id="<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>">
                                        <input type="hidden" class="rowNb" name="row<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getRow() ?>">
                                        <td>
                                            <select class="form-select type" aria-label="Default select example" disabled>
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
                                            <select class="form-select product" style="min-width: 95px;" aria-label="Default select example" name="product<?= $taskDetails['taskNumber'] ?>[]" disabled>
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
                                            <div class="currency-wrap">
                                                <span class="currency-code">€</span>
                                                <input type="number" step="any" data-type="currency" style="min-width: 40px;" class="alreadyBuy text-center form-control text-currency" name="alreadyBuy<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getExpense() ?>" disabled></input>
                                                <input type="hidden" step="any" data-type="currency" style="min-width: 40px;" class="alreadyBuy text-center form-control text-currency" name="alreadyBuy<?= $taskDetails['taskNumber'] ?>[]" value="<?= $productByTask->getExpense() ?>"></input>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="currency-wrap">
                                                <span class="currency-code">€</span>
                                                <input type="number" step="any" data-type="currency" style="min-width: 40px;" class="resultPrice text-center form-control text-currency" value="<?= $this->totalBudget($productByTask) ?>" disabled></input>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control text-center quantity" style="min-width: 40px;" id="quantity<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>" name="quantity<?= $taskDetails['taskNumber'] ?>[]" type="number" placeholder="<?= $productByTask->getQuantityProduct() ?>">
                                        </td>
                                        <td>
                                            <div class="currency-wrap">
                                                <span class="currency-code">€</span>
                                                <input class="form-control text-center unitPrice text-currency" style="min-width: 40px;" id="unitPrice<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>" name="unitPrice<?= $taskDetails['taskNumber'] ?>[]" type="number" step="any" placeholder="<?= $productByTask->getUnitPriceProduct() ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="currency-wrap">
                                                <span class="currency-code">€</span>
                                                <div type="number" data-type="currency" class="form-control order text-center text-currency" style="min-width: 40px;" id="order<?= $taskDetails['taskNumber'] . $productByTask->getRow() ?>">0</div>
                                                <input type="hidden" class="orderInput" name="expense<?= $taskDetails['taskNumber'] ?>[]" value="">
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <hr class="border border-primary border-1 opacity-100">
                    </input>
                <?php
            }
            require_once APP_PATH . "/views/blockModel.php";
                ?>
                </div>
                <div class="container text-end">
                    <input type="submit" value="Enregistrer dépense" class="btn btn-primary"></input>
    </form>

    <h5 class="resultPriceTotal"></h5>
    </input>
    <script src="JS/order.js"></script>
    <?php
    require_once APP_PATH . "/views/footer.php";
    ?>