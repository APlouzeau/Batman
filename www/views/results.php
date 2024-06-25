<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<h2 class="text-center text-uppercase mt-5">resultats</h2>
<h3 class="text-center text-uppercase pt-3"><?= $estimate->getNameEstimate(); ?></h3>

<div class="container pb-5">
    <?php
    foreach ($tasksList as $taskDetails) {
        $productsByTask = $tasksManager->getProductsByTask($taskDetails['id']);
    ?>
        <div class="py-2 block<?= $taskDetails['taskNumber'] ?>">
            <label for="description" class="fs-5 fw-bold">Description</label>
            <textarea rows="2" class="form-control description descriptionArea border-black" disabled><?= $taskDetails['descriptionTask'] ?></textarea>
            <div class="table-responsive">
                <table class="text-center table table-info">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Avancement</th>
                            <th>Budget prévu</th>
                            <th>Montant dépensé</th>
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
                                <td style="min-width: 140px"><?= number_format($this->projectedBudget($productByTask), 2, '.', ' ') . ' ' . $this->getUnitResults($productByTask) ?></td>
                                <td style="min-width: 140px"><?= number_format($productByTask->getExpense(), 2, '.', ' ') . ' ' . $this->getUnitResults($productByTask) ?></td>
                                <td class="remainingBudget" style="min-width: 140px"><?= number_format($this->remainingBudget($productByTask), 2, '.', ' ') . ' ' . $this->getUnitResults($productByTask) ?></td>
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
                        <td style="min-width: 140px"><?= $product->getName() ?></td>
                        <td style="min-width: 140px"><?= $productResult->getQuantityProduct() . ' ' . $productResult->getUnit() ?></td>
                        <td style="min-width: 140px"><?= number_format($this->totalBudget($productResult), 2, '.', ' ') . ' ' . $this->getUnitResults($productResult) ?> </td>
                        <td style="min-width: 140px"><?= number_format($productResult->getExpense(), 2, '.', ' ') . ' ' . $this->getUnitResults($productResult)  ?> </td>
                        <td style="min-width: 140px" class="margin"><?= number_format($this->getMarge($productResult, $margesMaterials, $margesWorkForce), 2, '.', ' ') . ' ' . $this->getUnitResults($productResult) ?> </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="../js/results.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
?>