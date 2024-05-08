<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
?>

<title>Accueil</title>

<?php
require_once "../views/header.php";
require_once "../controller/estimateManager.php";
require_once "../controller/customersManager.php";
require_once "../models/estimateModel.php";

$estimateManager = new EstimateManager();
$customersManager = new CustomersManager();

if ($_POST) {
    $nameEstimate = $_POST["nameEstimate"];
    $idCustomer = $_GET["id"];
    try {
        $newEstimate = new Estimate([
            "nameEstimate" => $nameEstimate,
            "idCustomer" => $idCustomer,
        ]);
        var_dump($newEstimate);
        $estimateManager->createEstimate($newEstimate);
        $estimate = $estimateManager->getEstimateIdByName($nameEstimate);
        $estimateId = $estimate->getId();
        header("Location:createEstimate.php?id=$estimateId");
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if ($_GET) {
    $selectedCustomer = $customersManager->getCustomers($_GET["id"]);
    $nameCustomer = $selectedCustomer->getNameCustomer();
    $contactCustomer = $selectedCustomer->getNameContact();
    $mailContact = $selectedCustomer->getMailContact();
    $adressContact = $selectedCustomer->getAdressContact();
}


?>
<div class="container justify-content-center">

    <form method="post" class="" style="min-height: 50em">
        <ul class="list-group ">
            <li class="list-group-item">
                <h6>Client</h6>
                <label class="form-label" for="customer">Nom / Entité</label>
                <input class="form-control" type="text" name="customer" id="idustomer" value="<?= $nameCustomer ?>">
            </li>

            <li class="list-group-item">
                <h6>Contact</h6>
                <label class="form-label" for="nameContact">Nom</label>
                <input class="form-control" type="text" name="nameContact" id="nameContact" placeholder="Nom de la personne à contacter" value="<?= $contactCustomer ?>">

                <label class="form-label" for="mailContact">Mail</label>
                <input class="form-control" type="mail" name="mailContact" id="mailContact" value="<?= $mailContact ?>">

                <label class="form-label" for="adressContact">Adresse</label>
                <input class="form-control" type="text" name="adressContact" id="adressContact" value="<?= $adressContact ?>">
            </li>

            <li class="list-group-item">
                <h6>Chantier</h6>
                <label class="form-label" for="nameEstimate">Nom</label>
                <input class="form-control" type="text" name="nameEstimate" id="nameEstimate" placeholder="Nom du chantier/devis">
            </li>
            <input type="submit" class="btn btn-success" value="Créer devis" id="addLine" />
        </ul>
    </form>
</div>


<?php
require_once "../views/footer.php";
?>