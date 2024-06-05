<div class="container d-flex align-items-center" style="min-height: 50em">
    <div class=" col-9 col-md-5 col-lg-4 col-xl-3 m-auto">
        <form method="get" action="<?= BASE_URL . 'editSituationPage'; ?>">
            <div class=" form-floating">
                <select class=" form-select selectEstimate" aria-label="Default select example" name="id">
                    <option selected>- -</option>
                    <?php foreach ($projectList as $project) { ?>
                        <option class="estimate" value="<?= $project['id'] ?>"><?= $project['nameEstimate'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="floatingSelect">Selectionner le chantier</label>
            </div>
            <input type="submit" class="btn btn-success" value="Selectionner chantier">
        </form>
    </div>
</div>