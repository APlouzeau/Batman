<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<form method="post" action="<?= BASE_URL . '';  ?>" class="container m-auto">
    <div class="col-6 col-md-5 col-lg-4 col-xl-3 m-auto">
        <label class="form-label" for="mail" id="mail">Email</label>
        <input type="email" name="mail" id="mail" class="form-control" required>
    </div>
    <div class="col-6 col-md-5 col-lg-4 col-xl-3 m-auto">
        <label class="form-label col-md-4" for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control col-md-4" required>
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-success mt-4 text-center errorAnchor" id="errorAnchor" value="Se connecter">
    </div>
</form>

<?php

?>