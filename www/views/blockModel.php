<div class="py-2 block" hidden>
    <input type="hidden" class="blocNb">
    <label for="description" class="fs-5 fw-bold">Description</label>
    <textarea rows="2" class="form-control description"></textarea>

    <table class="text-center table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Montant total</th>
            </tr>
        </thead>

        <tbody class="task">
            <tr class="row">
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
                    <select class="form-select product" aria-label="Default select example">
                        <?php foreach ($productList as $type => $product) { ?>
                            <option class="<?= $product->getType() ?>" value="<?= $product->getName() ?>"><?= $product->getName() ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input class="form-control quantity" type="number">
                </td>
                <td>
                    <input class="form-control unitPrice" type="number" step="0.01" value="">
                </td>
                <td>
                    <div class="resultPrice"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="button" class="btn btn-success addLineBlock" value="Ajouter ligne" />
    <hr class="border border-primary border-1 opacity-100">
</div>