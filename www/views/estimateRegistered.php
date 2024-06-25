<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<title>Devis à enregistrer</title>
<div class="work d-flex">
    <div class="container d-flex align-items-center" ">
        <form method=" get" class="container" action="<?= BASE_URL . 'registerdriver'; ?>">
        <div class="col-9 col-md-5 col-lg-4 col-xl-3 m-auto">
            <div class=" form-floating">
                <select class="form-select selectEstimate" aria-label="Default select example" name="id">
                    <option selected>- -</option>
                    <?php foreach ($estimateList as $estimate) { ?>
                        <option class="estimate" value="<?= $estimate->getId() ?>"><?= $estimate->getNameEstimate() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="floatingSelect">Devis enregistrés</label>
                <input type="submit" value="Enregistrer chantier" class="btn btn-success">
            </div>
        </div>
        </form>
    </div>
</div>
<?php
require_once APP_PATH . "/views/footer.php";
?>