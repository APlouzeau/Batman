<?php
require_once APP_PATH . "/../views/head.php";
?>

<title>Edition devis</title>

<?php
require_once APP_PATH . "/../views/header.php";
require_once APP_PATH . "/../controller/estimateManager.php";

$estimateManager = new EstimateManager();
$estimateList = $estimateManager->showEstimate();

?>
<div class="container">
    <select class="form-select selectEstimate" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <?php foreach ($estimateList as $estimate) { ?>
            <option class="estimate" value="<?= $estimate->getId() ?>"><?= $estimate->getNameEstimate() ?></option>
        <?php
        }
        ?>
    </select>
    <a href="views/modifyEstimate.php?id=" class="link btn btn-warning align-items-center" type="button">Modifier Devis</a>
</div>
<script src="JS/searchEstimateScript.js"></script>

