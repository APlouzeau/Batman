<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Chantiers</title>

<h3 class="text-center text-uppercase mt-5">Chantiers</h3>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 50em">
    <div class="buttonSelection ">
        <?php if ($_SESSION['role'] != 'Assistant') {
        ?>
            <button type="button" class="btn btn-success situationButton">Situation</button>
            <button type="button" class="btn btn-success orderButton">Commande</button>
        <?php
        } ?>
        <button type="button" class="btn btn-success resultsButton">Résultats</button>
    </div>
    <form method="post" action="<?= BASE_URL . 'editSituationPage'; ?>" class="situation text-center" hidden>
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="form-floating">
            <select class=" form-select selectEstimate" aria-label="Default select example" name="idEstimate">
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
        <button type="button" class="btn btn-danger returnSituation" hidden>Retour</button>
    </form>
    <form method="post" action="<?= BASE_URL . 'orderPage'; ?>" class="order text-center" hidden>
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class=" form-floating">
            <select class=" form-select selectEstimate" aria-label="Default select example" name="idEstimate">
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
        <button type="button" class="btn btn-danger returnOrder" hidden>Retour</button>
    </form>
    <form method="post" action="<?= BASE_URL . 'resultsPage'; ?>" class="results text-center" hidden>
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="form-floating">
            <select class=" form-select selectEstimate" aria-label="Default select example" name="idEstimate">
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
        <button type="button" class="btn btn-danger returnResults" hidden>Retour</button>
    </form>
</div>
<script src="../js/projects.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";
?>