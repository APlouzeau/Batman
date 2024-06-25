<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Produits</title>

<h3 class="text-center text-uppercase mt-5" data-bs-toggle="popover" title="Popover Header" data-bs-content="Some content inside the popover">Produits</h3>
<input class="role" type="hidden" name="role" value="<?= $_SESSION['role'] ?>">
<div class="work d-flex flex-column justify-content-center container buttonProducts align-items-center">
    <div>
        <button type="button" class="btn btn-success addProduct">Nouveau Produit</button>
        <button type="button" class="btn btn-success showCatalog">Catalogue</button>
    </div>
    <div class="container catalog mt-5" hidden>
        <section class="d-flex flex-wrap justify-content-center">
            <?php
            $products = $productsManager->showProductsCatalog();
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

    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <div class="formAddProducts col-10 col-md-6 col-xxl-4" hidden>
                <form method="post" class=" mt-5" style="min-height:50em" action="<?= BASE_URL . 'create'; ?>">
                    <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <label class="form-label" for="name">Nom / Ref</label>
                    <label class="errorName fw-bold" hidden></label>
                    <div class="d-flex">
                        <input type="name" name="name" id="name" class="form-control" min=1 max=100 placeholder="Référence du produit" onchange="verifyName(this)">
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Indiquer ici le nom du produit, tel qu'il apparaitra en titre dans sa vignette de catalogue."></i>
                    </div>
                    <label class="form-label" for="type">Type</label>
                    <div class="d-flex">
                        <select class="form-select" type="type" name="type" id="type" aria-label="Default select example">
                            <?php foreach ($typesList as $type) { ?>
                                <option class="" value="<?= $type->getID() ?>"><?= $type->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Indiquer ici la catégorie du produit. Cela servira à regrouper les dépenses par familles de produits, afin d'analyser les résultats."></i>
                    </div>
                    <label class="form-label" for="length">Longueur</label>
                    <div class="d-flex">
                        <input type="number" name="length" id="length" step="0.01" class="form-control" onkeydown="return event.keyCode !== 69" placeholder="Longueur du produit">
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Indiquer ici la taille du produit, si celui-ci en a une. Ceci peut par exemple servir à calculer le nombre de rouleau à commander"></i>
                    </div>
                    <label class="form-label" for="recovery">Recouvrement</label>
                    <div class="d-flex">
                        <input type="number" name="recovery" id="recovery" step="0.01" class="form-control" onkeydown="return event.keyCode !== 69" placeholder="Le recouvrement longitudinal en mm"></input>
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="La largeur de superposition des produits l'un sur l'autre aide à calculer les pertes."></i>
                    </div>
                    <label class="form-label" for="summary">Résumé</label>
                    <div class="d-flex">
                        <textarea type="text" name="summary" id="summary" class="form-control" placeholder="Résumé succint concernant le rouleau"></textarea>
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Le résumé sera affiché dans les vignettes du produits dans le catalogue."></i>
                    </div>
                    <label class="form-label" for="descriptionProduct">Description</label>
                    <div class="d-flex">
                        <textarea type="text" name="descriptionProduct" id="descriptionProduct" class="form-control" placeholder="Description/destination du produit"></textarea>
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="La description complète sera affichée sur la page dédiée au produit. Essayez d'être le plus précis possible."></i>
                    </div>
                    <label class="form-label" for="price">Prix</label>
                    <div class="d-flex">
                        <input type="number" name="price" id="price" class="form-control" step="0.01" onkeydown="return event.keyCode !== 69" placeholder="Prix"></input>
                        <select class="form-select" type="unit" name="unit">
                            <option value="m2">m²</option>
                            <option value="ml">ml</option>
                            <option value="uni">uni</option>
                            <option value="Kg">Kg</option>
                        </select>
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Le prix d'achat du produit, en fonction de l'unité de prix normale conseillée pour ledit produit."></i>
                    </div>
                    <input type="submit" value="Créer" class="btn btn-success mt-3 createButton" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tooltip on right" disabled>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<script src="../js/products.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
