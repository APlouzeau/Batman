<title>Devis à enregistrer</title>

<form method="get" class="container" action="<?= BASE_URL . 'registerdriver'; ?>">
    <select class="form-select selectEstimate" aria-label="Default select example" name="id">
        <option selected>Open this select menu</option>
        <?php foreach ($estimateList as $estimate) { ?>
            <option class="estimate" value="<?= $estimate->getId() ?>"><?= $estimate->getNameEstimate() ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="Enregistrer chantier" class="btn btn-success">
</form>