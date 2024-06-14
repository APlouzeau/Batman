<title>Résultats</title>
<h3 class="text-center text-uppercase pt-3"><?= $estimate->getNameEstimate(); ?></h3>

<div class="container pb-5">
    <?php
    foreach ($tasksList as $taskDetails) {
        $productsByTask = $tasksManager->getProductsByTask($taskDetails['id']);
    ?>
        <div class="py-2 block<?= $taskDetails['taskNumber'] ?>">
            <label for="description" class="fs-5 fw-bold">Description</label>
            <textarea rows="2" class="form-control description" disabled><?= $taskDetails['descriptionTask'] ?></textarea>
        </div>
        <div class="row d-flex text-center">
            <ul class="">
                <li class="list-group-item">
                    <ul class="list-group flex-row ">
                        <li class="w-100 list-group-item fw-bold">Produit</li>
                        <?php foreach ($productsByTask as $productByTask) {
                            $product = $productsManager->getProductsById($productByTask->getIdProduct());
                        ?>
                            <li class="w-100 list-group-item"><?= $product->getName() ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <ul class="list-group flex-row ">
                    <li class="w-100 list-group-item fw-bold">Quantité</li>
                    <?php foreach ($productsByTask as $productByTask) {
                        $product = $productsManager->getProductsById($productByTask->getIdProduct());
                    ?>
                        <li class="w-100 list-group-item"><?= $productByTask->getQuantityProduct() ?></li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="list-group flex-row ">
                    <li class="w-100 list-group-item fw-bold">Avancement</li>
                    <?php foreach ($productsByTask as $productByTask) {
                        $product = $productsManager->getProductsById($productByTask->getIdProduct());
                    ?>
                        <li class="w-100 list-group-item"><?= $productByTask->getSituation() ?> %</li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="list-group flex-row ">
                    <li class="w-100 list-group-item fw-bold">Budget prévu</li>
                    <?php foreach ($productsByTask as $productByTask) {
                        $product = $productsManager->getProductsById($productByTask->getIdProduct());
                    ?>
                        <li class="w-100 list-group-item"><?= $this->projectedBudget($productByTask) ?> €</li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="list-group flex-row ">
                    <li class="w-100 list-group-item fw-bold">Budget restant</li>
                    <?php foreach ($productsByTask as $productByTask) {
                        $product = $productsManager->getProductsById($productByTask->getIdProduct());
                    ?>
                        <li class="w-100 list-group-item"><?= $this->remainingBudget($productByTask) ?> €</li>
                    <?php
                    }
                    ?>
                </ul>
            </ul>
        </div>
    <?php
    }
    ?>
    <div class="text-center">
        <ul class="list-group list-group-horizontal list-group-flush">
            <li class="w-100 list-group-item"><?= $productByTask->getQuantityProduct() ?></li>
            <li class="w-100 list-group-item"><?= $productByTask->getSituation() ?> %</li>
            <li class="w-100 list-group-item"><?= $this->projectedBudget($productByTask) ?> €</li>
        </ul>
    </div>
    <hr class="border border-primary border-5 opacity-100">
    <div class="container text-center">
        <ul class="list-group list-group-horizontal fw-bold list-group-flush">
            <li class="w-100 col list-group-item">Produit</li>
            <li class="w-100 col list-group-item">Quantité totale</li>
            <li class="w-100 col list-group-item">Budget Total</li>
            <li class="w-100 col list-group-item">Montant dépensé</li>
            <li class="w-100 col list-group-item">Marge</li>
        </ul>
    </div>
    <?php
    foreach ($productsResultList as $productResult) {
        $product = $productsManager->getProductsById($productResult->getIdProduct());
    ?>
        <div class="container text-center product" ?>
            <ul class="list-group list-group-horizontal">
                <li class=" w-100 col list-group-item"><?= $product->getName() ?></li>
                <li class="w-100 col list-group-item quantity"><?= $productResult->getQuantityProduct() ?></li>
                <li class="w-100 col list-group-item totalBudget"><?= $this->totalBudget($productResult) ?> €</li>
                <li class="w-100 col list-group-item totalSpend"><?= $productResult->getExpense() ?> €</li>
                <li class="w-100 col list-group-item margin"><?= $this->getMarge($productResult, $marges) ?> €</li>
            </ul>
        </div>


    <?php
    }
    ?>
</div>
<script src="../JS/results.js"></script>