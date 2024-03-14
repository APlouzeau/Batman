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
    <input type="number" name="length" id="length" class="form-control" placeholder="Longueur du rouleau">
    <label class="form-label" for="recovery">Recouvrement</label>
    <input type="number" name="recovery" id="recovery" class="form-control" placeholder="Le recouvrmeent longitudinal"></input>
    <label class="form-label" for="description">Description</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Description/destination du rouleau"></input>
    <label class="form-label" for="price">Prix</label>
    <input type="text" name="price" id="price" class="form-control" placeholder="Prix au m²"></input>
    <input type="submit" value="Créer" class="btn btn-success mt-3">



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    </body>

    </html>