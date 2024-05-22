<form method="post" class="container" action="<?= BASE_URL . 'modify?id=' . $product->getId(); ?>">
    <label class="form-label" for="name">Nom / Ref</label>
    <input type="name" name="name" id="name" class="form-control" min=1 max=255 value="<?= $product->getName() ?>">
    <label class="form-label" for="type">Type</label>
    <select class="form-select" type="type" name="type" id="type" aria-label="Default select example">
        <?php foreach ($typesList as $type) { ?>
            <option class="" value="<?= $type->getID() ?>"><?= $type->getName() ?></option>
        <?php
        }
        ?>
        <label class="form-label" for="length">Longueur</label>
        <input type="number" name="length" id="length" class="form-control" placeholder="Longueur du rouleau en m" value="<?= $product->getLength() ?>">
        <label class="form-label" for="recovery">Recouvrement</label>
        <input type="number" name="recovery" id="recovery" class="form-control" placeholder="Le recouvrement longitudinal en mm" value="<?= $product->getRecovery() ?>"></input>
        <label class="form-label" for="summary">Résumé</label>
        <input type="text" name="summary" id="summary" class="form-control" placeholder="Résumé succint concernant le rouleau" value="<?= $product->getSummary() ?>"></input>
        <label class="form-label" for="descriptionProduct">Description</label>
        <input type="text" name="descriptionProduct" id="descriptionProduct" class="form-control" placeholder="Description/destination du rouleau" value="<?= $product->getDescriptionProduct() ?>"></input>
        <label class="form-label" for="price">Prix</label>
        <input type="text" name="price" id="price" class="form-control" placeholder="Prix au m²" value="<?= $product->getPrice() ?>"></input>
        <input type="submit" value="Modifier" class="btn btn-success mt-3">
</form>

<?php
require_once APP_PATH . "/views/footer.php";
