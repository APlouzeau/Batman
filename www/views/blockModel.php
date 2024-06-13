<div class="py-2 block" hidden>
    <input type="hidden" class="blocNb">
    <label for="description" class="fs-5 fw-bold">Description</label>
    <textarea rows="2" class="form-control description"></textarea>
    <div class="table-responsive">
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
                    <input type="hidden" class="rowNb" name="" value="">
                    <td>
                        <select class="form-select type" style="min-width: 95px;" id="type" aria-label="Default select example">
                            <?php foreach ($typesList as $type) { ?>
                                <option class="" value="<?= $type->getName() ?>"><?= $type->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-select product" style="min-width: 95px;" aria-label="Default select example">
                            <?php foreach ($productList as $type => $product) { ?>
                                <option class="<?= $product->getType() ?>" data-getUnit="<?= $product->getUnit() ?>" data-getPrice="<?= $product->getPrice() ?>" value="<?= $product->getName() ?>"><?= $product->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <div class="currency-wrap">
                            <span class="currency-code unit"></span>
                            <input class="form-control quantity text-center" style="min-width: 40px;" type="number">
                        </div>
                    </td>
                    <td>
                        <div class="currency-wrap">
                            <span class="currency-code">€</span>
                            <input class="form-control unitPrice text-center" style="min-width: 40px;" type="number" step="0.01" value="">
                        </div>
                    </td>
                    <td>
                        <div class="currency-wrap">
                            <span class="currency-code">€</span>
                            <div class="resultPrice text-center" style="min-width: 40px;" step="0.01" value=""></div>
                        </div>
                    </td>
                    <td>
                        <div class="remove">X</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="button" class="btn btn-success addLineBlock" value="Ajouter ligne" />
    <hr class="border border-primary border-1 opacity-100">
</div>