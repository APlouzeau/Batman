<?php
require_once APP_PATH . "/views/head.php";
?>

<title>Accueil</title>

<?php
require_once APP_PATH . "/views/header.php";
require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/customersManager.php";
require_once APP_PATH . "/models/estimateModel.php";




?>
<div class="container justify-content-center">

    <form method="post" class="" style="min-height: 50em" action="<?= BASE_URL . 'createEstimate'; ?>">
        <input type="hidden" name="id" value="<?= $selectedCustomer->getId() ?>">
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
require_once APP_PATH . "/views/footer.php";
?>