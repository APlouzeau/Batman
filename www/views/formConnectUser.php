<?php
require_once APP_PATH . "/views/head.php";
?>

<title>Connexion</title>



<form method="post" action="<?= BASE_URL . ''; ?>" class="container w-25">
    <div class="d-flex flex-column">
        <label class=" form-label" for="mail">Email</label>
        <input type="email" name="mail" id="mail" class="form-control" required>
        <label class="form-label" for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <input type="submit" class="btn btn-success m-3" value="Se connecter">
    </div>
</form>

