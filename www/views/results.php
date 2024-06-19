<title>Résultats</title>
<h3 class="text-center text-uppercase pt-3"><?= $estimate->getNameEstimate(); ?></h3>

<div class="container pb-5">
    <?php
    foreach ($tasksList as $taskDetails) {
        $productsByTask = $tasksManager->getProductsByTask($taskDetails['id']);
    ?>
        <div class="py-2 block<?= $taskDetails['taskNumber'] ?>">
            <label for="description" class="fs-5 fw-bold">Description</label>
            <textarea rows="2" class="form-control description bg-info bg-gradient" disabled><?= $taskDetails['descriptionTask'] ?></textarea>
            <div class="table-responsive">
                <table class="text-center table table-info">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Avancement</th>
                            <th>Budget prévu</th>
                            <th>Budget restant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($productsByTask as $productByTask) {
                            $product = $productsManager->getProductsById($productByTask->getIdProduct());
                        ?>
                            <tr>
                                <td style="min-width: 140px"><?= $product->getName() ?></td>
                                <td style="min-width: 140px"><?= $productByTask->getQuantityProduct() . ' ' . $product->getUnit()  ?></td>
                                <td style="min-width: 140px"><?= $productByTask->getSituation() ?> %</td>
                                <td style="min-width: 140px"><?= $this->projectedBudget($productByTask) ?> €</td>
                                <td style="min-width: 140px"><?= $this->remainingBudget($productByTask) ?> €</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    }
    ?>
    <hr class="border border-primary border-5 opacity-100">
    <div class="table-responsive">
        <table class="text-center table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité totale</th>
                    <th>Budget Total</th>
                    <th>Montant dépensé</th>
                    <th>Marge</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($productsResultList as $productResult) {
                    $product = $productsManager->getProductsById($productResult->getIdProduct());
                ?>
                    <tr>
                        <td><?= $product->getName() ?></td>
                        <td><?= $productResult->getQuantityProduct() ?></td>
                        <td><?= $this->totalBudget($productResult) ?> €</td>
                        <td><?= $productResult->getExpense() ?> €</td>
                        <td class="margin"><?= $this->getMarge($productResult, $marges) ?> €</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="../js/results.js"></script>