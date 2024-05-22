<?php
require_once APP_PATH . "/views/head.php";
?>

<title>Client</title>

<?php
require_once APP_PATH . "/views/header.php";
require_once APP_PATH . "/models/productsManager.php";
require_once APP_PATH . "/models/typesManager.php";
require_once APP_PATH . "/models/customersManager.php";
require_once APP_PATH . "/models/estimateManager.php";
require_once APP_PATH . "/models/estimateModel.php";



?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 50em" id="divButtonsEstimate">
    <div class="" id="buttonsEstimate">
        <button type="button" class="btn btn-success newEstimate" id="newEstimate">Nouveau</button>
        <a href="<?= BASE_URL . 'searchEstimate'; ?>" type="button" class="btn btn-warning modifyEstimate" id="modifyEstimate">Modifier</a>
    </div>
    <div class="" id="buttonsCustomer" hidden=true>
        <button type="button" class="btn btn-success newCustomer" id="newCustomer">Nouveau Client</button>
        <a href="<?= BASE_URL . 'searchCustomer'; ?>" type="button" class="btn btn-warning existantCustomer" id="existantCustomer">Client existant</a>
        <button type="button" class="btn btn-danger newCustomer" id="buttonsBackEstimate" hidden=true>Retour</button>
    </div>
    <div class="container" id="formEstimate" hidden=true>
        <form method="post" action="<?= BASE_URL . 'addCustomer'; ?>">
            <ul class="list-group">
                <li class="list-group-item">

                    <h5>Nouveau client</h5>
                    <label class="form-label" for="nameCustomer">Nom / Entité</label>
                    <input class="form-control" type="text" name="nameCustomer" id="nameCustomer">

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
            <button type="button" class="btn btn-danger newCustomer" id="buttonsBackNewCustomer" hidden=true>Retour</button>
        </form>
    </div>
</div>
<script src="../JS/estimate.JS"></script>
<?php
require_once APP_PATH . "/views/footer.php";
?>