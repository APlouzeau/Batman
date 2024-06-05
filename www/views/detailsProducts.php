<title><?= $roll->getName() ?></title>

<div class="container">
    <div class="col-lg-6 m-auto">
        <h2 class="text-center"><?= $roll->getName() ?></h2>
        <h4>Description</h4>
        <p><?= $roll->getDescriptionProduct() ?></p>
        <h5>Recouvrement</h5>
        <p><?= $roll->getRecovery() ?> mm</p>
        <h5>Prix</h5>
        <p><?= $roll->getPrice() ?> €/m²</p>
    </div>
</div>