<title>Edition devis</title>

<div class="container">
    <h3 class="text-center text-uppercase">Creation de nouveau devis</h3>
    <form method="post" action="<?= BASE_URL . 'saveEstimate'; ?>">
        <h3 class="text-center text-uppercase"><?= $estimate->getNameEstimate(); ?></h3>
        <input type="hidden" name="idEstimate" value="<?= $estimate->getId(); ?>">
        <input type="hidden" id="taskQuantity" value="1">
        <input type="hidden" id="rowCount" value="0">
        <div class="blockList">
            <div class="py-2 block0" id="block0">
                <input type="hidden" name="taskNumber0[]" value="0">
                <label for="description" class="fs-5 fw-bold">Description</label>
                <textarea rows="2" class="form-control description" name="description0" required></textarea>
                <div class="table-responsive">
                    <table class="text-center table table0 table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Montant total</th>
                            </tr>
                        </thead>

                        <tbody class="task0">
                            <tr class="row01" style="min-width: 95px" id="01">
                                <input type="hidden" class="rowNb" name="row0" value="0">
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
                                    <select class="form-select product" aria-label="Default select example" name="product0[]">
                                        <?php foreach ($productList as $type => $product) { ?>
                                            <option class="<?= $product->getType() ?>" value="<?= $product->getName() ?>"><?= $product->getName() ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control quantity" style="min-width: 40px" name="quantity0[]" type="number" required>
                                </td>
                                <td>
                                    <input class="form-control unitPrice" style="min-width: 40px" name="unitPrice0[]" type="number" step="any" id="unitPrice" value="" required>
                                </td>
                                <td>
                                    <div type="number" step="any" data-type="currency" class="resultPrice0"></div>
                                </td>
                                <td>
                                    <div class="remove">X</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="button" class="btn btn-success addLineBlock1" value="Ajouter ligne" id="addLineBlock1" onclick="addLine('.row', 0)" />
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