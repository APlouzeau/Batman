<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<title>Comptabilité</title>
<h3 class="text-center text-uppercase mt-5">Comptabilité</h3>
<div class="work d-flex">
    <div class="container d-flex justify-content-center align-items-center" id="divButtonsEstimateToRegister">
        <div class="" id="buttonEstimateToRegister">
            <a href="<?= BASE_URL . 'estimateToRegister'; ?>" type="button" class="btn btn-warning modifyEstimate">Devis à enregistrer</a>
            <a href="<?= BASE_URL . 'estimateRegistered'; ?>" type="button" class="btn btn-success modifyEstimate">Devis enregistrés</a>
        </div>
    </div>
</div>
<script src="../js//accounting.js"></script>

<?php
require_once APP_PATH . "/views/footer.php";
?>