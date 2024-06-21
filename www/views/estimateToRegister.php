<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<title>Devis à enregistrer</title>

<div class="container d-flex align-items-center" style="min-height: 50em">
    <form method="post" class="container" action="<?= BASE_URL . 'registerdriver'; ?>">
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
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
                <label for="floatingSelect">Devis à enregistrer</label>
            </div>
            <div class=" form-floating">
                <select class="form-select selectEstimate" aria-label="Default select example" name="driver">
                    <option selected>- -</option>
                    <?php foreach ($driverList as $driver) { ?>
                        <option class="estimate" value="<?= $driver->getId() ?>"><?= $driver->getFirstName() . ' ' . $driver->getName() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="floatingSelect">Conducteur de travaux</label>
            </div>
            <input type="submit" value="Enregistrer chantier" class="btn btn-success">
        </div>

    </form>
</div>
<?php
require_once APP_PATH . "/views/footer.php";
?>