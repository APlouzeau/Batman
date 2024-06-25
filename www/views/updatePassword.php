<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Profil</title>


<div class="container updatePassword col-md-4 col-xl-2">
    <form action="<?= BASE_URL . 'updatePassword'; ?>" method="post" class="work d-flex flex-column justify-content-center align-items-center">
        <input class="csrf_token" type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <label for="oldPassword">Ancien mot de passe</label>
                    <input type="password" name="oldPassword" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="password">Mot de passe
                        <i class="fa-sharp fa-solid fa-circle-info m-auto" title="Le mot de passe doit contenir 8 à 16 caractères, au moins un chiffre, une lettre minuscule et une majuscule, pas d'espace, et un symbole."></i>
                    </label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="passwordVerify">Réécrivez le mot de passe</label>
                    <input type="password" name="passwordVerify" class="form-control">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12"><input type="submit" class="btn btn-success m-3" value="Modifier"></div>
            </div>
        </div>
    </form>
</div>
<?php
require_once APP_PATH . "/views/footer.php";
?>