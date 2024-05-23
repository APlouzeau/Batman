<title>Edition devis</title>

<?php


/* $j = 0;
    foreach ($_POST['product' . $i] as $key => $value) {
    $newProductByTask = new ProductByTask([
    'idProductByTask' => '2',
    'idProduct' => '3',
    'idTask' => '4',
    'quantityProduct' => $_POST["quantity" . $i][$j],
    'unitPriceProduct' => $_POST["unitPrice" . $i][$j]
    ]);
    } */
?>
<div class="container">
    <form method="post" action="<?= BASE_URL . 'createEstimate'; ?>">
        <h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId(); ?>">
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
                <input type="button" class="btn btn-success addLineBlock1" value="Ajouter ligne" id="addLineBlock1" onclick="addLine('.rowModel', 0)" />
                <hr class="border border-primary border-1 opacity-100">
            </div>
            <?php
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