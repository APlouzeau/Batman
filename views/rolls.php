<?php
define("BASE_URL", "/EYOSOP");
require_once "./head.php";
?>

<title>Ajout de nouveau rouleau</title>

<?php
require_once "./header.php";
require_once "../controller/rollsManager.php";

$rollsManager = new RollsManager();

if ($_POST) {
    $name = $_POST["name"];
    $length = $_POST["length"];
    $recovery = $_POST["recovery"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    try {
        $newRoll = new Rolls([
            "name" => $name,
            "length" => $length,
            "recovery" => $recovery,
            "description" => $description,
            "price" => $price,
        ]);
        $rollsManager->addRolls($newRoll);
        echo "L'ajout a réussi.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


?>
<form method="post" class="container">
    <label class="form-label" for="name">Nom / Ref</label>
    <input type="name" name="name" id="name" class="form-control" min=1 max=901 placeholder="Référence du rouleau">
    <label class="form-label" for="length">Longueur</label>
    <input type="number" name="length" id="length" class="form-control" placeholder="Longueur du rouleau en m">
    <label class="form-label" for="recovery">Recouvrement</label>
    <input type="number" name="recovery" id="recovery" class="form-control" placeholder="Le recouvrement longitudinal en mm"></input>
    <label class="form-label" for="description">Description</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Description/destination du rouleau"></input>
    <label class="form-label" for="price">Prix</label>
    <input type="text" name="price" id="price" class="form-control" placeholder="Prix au m²"></input>
    <input type="submit" value="Créer" class="btn btn-success mt-3">
</form>

<div class="container">
    <section class="d-flex flex-wrap justify-content-center">
        <?php
        $rolls = $rollsManager->showRolls();
        foreach ($rolls as $roll) :
        ?>
            <div class="card m-4" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $roll->getName() ?></h5>
                    <p class="card-text"><?= $roll->getDescription() ?></p>
                    <div class="d-flex justify-content-around align-items-end">
                        <a href="#" class="btn btn-primary">Détails</a>
                        <a href="../views/modifyRolls.php?id=<?= $roll->getId() ?>" class="btn btn-warning">Modifier</a>
                        <a href="../views/deleteRolls.php?id=<?= $roll->getId() ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>

<?php
require_once "../views/footer.php";
