<title>Produits</title>

<h3 class="text-center text-uppercase mt-5">Produits</h3>
<input class="role" type="hidden" name="role" value="<?= $_SESSION['role'] ?>">
<div class="container d-flex align-items-center justify-content-center" hidden>
    <div class="buttonProducts" hidden>
        <button type="button" class="btn btn-success addProduct">Nouveau Produit</button>
        <button type="button" class="btn btn-success showCatalog">Catalogue</button>
    </div>
</div>


<div class="container catalog mt-5" hidden>
    <section class="d-flex flex-wrap justify-content-center">
        <?php
        $products = $productsManager->showProducts();
        foreach ($products as $product) :
        ?>
            <div class="card m-4" style="width: 20rem;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title"><?= $product->getName() ?></h5>
                    <p class="card-text"><?= $product->getSummary() ?></p>
                    <p class="list-group-item">Prix : <?= $product->getPrice() ?> €/m²</p>
                    <div class="text-center">
                        <a href="<?= BASE_URL . 'details?id=' . $product->getId(); ?>" class="btn btn-primary">Détails</a>
                        <?php
                        if ($_SESSION['role'] == 'Administrateur') {
                        ?>
                            <a href="<?= BASE_URL . 'modify?id=' . $product->getId(); ?>" class="btn btn-warning">Modifier</a>
                            <a href="<?= BASE_URL . 'delete?id=' . $product->getId(); ?>" class="btn btn-danger">Supprimer</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>

<div class="formAddProducts" hidden>
    <form method="post" class="container mt-5" style="min-height:50em" action="<?= BASE_URL . 'create'; ?>">
        <div class="col-7 col-md-6 col-lg-5 col-xl-4 m-auto">
            <label class="form-label" for="name">Nom / Ref</label>
            <input type="name" name="name" id="name" class="form-control" min=1 max=100 placeholder="Référence du rouleau">
            <label class="form-label" for="type">Type</label>
            <select class="form-select" type="type" name="type" id="type" aria-label="Default select example">
                <?php foreach ($typesList as $type) { ?>
                    <option class="" value="<?= $type->getID() ?>"><?= $type->getName() ?></option>
                <?php
                }
                ?>
            </select>
            <label class="form-label" for="length">Longueur</label>
            <input type="number" name="length" id="length" class="form-control" onkeydown="return event.keyCode !== 69" placeholder="Longueur du rouleau en m">
            <label class="form-label" for="recovery">Recouvrement</label>
            <input type="number" name="recovery" id="recovery" class="form-control" onkeydown="return event.keyCode !== 69" placeholder="Le recouvrement longitudinal en mm"></input>
            <label class="form-label" for="summary">Résumé</label>
            <textarea type="text" name="summary" id="summary" class="form-control" placeholder="Résumé succint concernant le rouleau"></textarea>
            <label class="form-label" for="descriptionProduct">Description</label>
            <textarea type="text" name="descriptionProduct" id="descriptionProduct" class="form-control" placeholder="Description/destination du rouleau"></textarea>
            <label class="form-label" for="price">Prix</label>
            <input type="number" name="price" id="price" class="form-control" onkeydown="return event.keyCode !== 69" placeholder="Prix au m²"></input>
            <input type="submit" value="Créer" class="btn btn-success mt-3">
        </div>
    </form>
</div>

</div>

<script src="../JS/products.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
