<title>Edition devis</title>

<div class="container">
    <select class="form-select selectEstimate" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <?php foreach ($estimateList as $estimate) { ?>
            <option class="estimate" value="<?= $estimate->getId() ?>"><?= $estimate->getNameEstimate() ?></option>
        <?php
        }
        ?>
    </select>
    <a href="<?= BASE_URL . 'modifyEstimate'; ?>" class="link btn btn-warning align-items-center" type="button">Modifier Devis</a>
</div>
<script src="JS/searchEstimateScript.js"></script>