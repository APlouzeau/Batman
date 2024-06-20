<title>Devis à enregistrer</title>

<div class="container d-flex align-items-center" style="min-height: 50em">
    <form method="post" class="container" action="<?= BASE_URL . 'registerdriver'; ?>">
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