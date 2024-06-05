<title>Edition devis</title>

<div class="container">
    <form action="<?= BASE_URL . 'modifyEstimate'; ?>" method="post">
        <select class="form-select selectEstimate" aria-label="Default select example" name="idEstimate">

            <option selected>Open this select menu</option>
            <?php foreach ($estimateList as $estimate) { ?>
                <option class="estimate" value="<?= $estimate->getId() ?>"><?= $estimate->getNameEstimate() ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Modifier devis" class="btn btn-warning">
    </form>
</div>
<script src="JS/searchEstimateScript.js"></script>