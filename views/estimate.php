<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
?>

<title>Accueil</title>

<?php
require_once "../views/header.php";
require_once "../controller/estimateManager.php";
require_once "../controller/productsManager.php";
require_once "../controller/typesManager.php";
require_once "../controller/customersManager.php";
require_once "../models/estimateModel.php";

$customersManager = new CustomersManager();

if ($_POST) {
    var_dump($_POST);
    $name = $_POST["name"];
    $adress = $_POST["adress"];
    $mailGeneric = $_POST["mailGeneric"];
    $siren = $_POST["siren"];
    $nameContact = $_POST["nameContact"];
    $mailContact = $_POST["mailContact"];
    $adressContact = $_POST["adressContact"];
    try {
        $newCustomer = new Customers([
            "name" => $name,
            "adress" => $adress,
            "mailGeneric" => $mailGeneric,
            "siren" => $siren,
            "nameContact" => $nameContact,
            "mailContact" => $mailContact,
            "adressContact" => $adressContact,
        ]);
        var_dump($newCustomer);
        $customersManager->addCustomer($newCustomer);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 50em" id="divButtonsEstimate">
    <div class="" id="buttonsEstimate">
        <button type="button" class="btn btn-success newEstimate" id="newEstimate">Nouveau</button>
        <a href="../views/modifyEstimate.php" type="button" class="btn btn-warning modifyEstimate" id="modifyEstimate">Modifier</a>
    </div>
    <div class="" id="buttonsCustomer" hidden=true>
        <button type="button" class="btn btn-success newCustomer" id="newCustomer">Nouveau Client</button>
        <button type="button" class="btn btn-warning existantCustomer" id="existantCustomer">Client existant</button>
    </div>
    <div class="container" id="formEstimate" hidden=true>
        <form method="post">
            <ul class="list-group">
                <li class="list-group-item">

                    <h5>Nouveau client</h5>
                    <label class="form-label" for="name">Nom / Entité</label>
                    <input class="form-control" type="text" name="name" id="name">

                    <label class="form-label" for="adress">Adresse</label>
                    <input class="form-control" type="text" name="adress" id="adress">

                    <label class="form-label" for="mailGeneric">Mail</label>
                    <input class="form-control" type="mail" name="mailGeneric" id="mailGeneric" placeholder="Adresse mail générique">

                    <label class="form-label" for="siren">SIREN / SIRET</label>
                    <input class="form-control" type="number" name="siren" id="siren">
                </li>

                <li class="list-group-item">
                    <h6>Contact</h6>
                    <label class="form-label" for="nameContact">Nom</label>
                    <input class="form-control" type="text" name="nameContact" id="nameContact" placeholder="Nom de la personne à contacter">

                    <label class="form-label" for="mailContact">Mail</label>
                    <input class="form-control" type="mail" name="mailContact" id="mailContact">

                    <label class="form-label" for="adressContact">Adresse</label>
                    <input class="form-control" type="text" name="adressContact" id="adressContact">
                </li>

            </ul>
            <input type="submit" class="btn btn-success" value="Ajouter" id="addLine" />
        </form>
    </div>
</div>
<script src="../JS/estimate.JS"></script>
<?php
require_once "../views/footer.php";
?>