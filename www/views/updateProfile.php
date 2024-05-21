<?php

$userController = new userController();

?>

<title>Profil</title>

<?php
require_once APP_PATH . "/views/header.php";
?>

<div class="container d-flex flex-column align-items-center">
    <div>
        <form action="<?= BASE_URL . 'updateProfile'; ?>" method="post">
            <label for="firstName">Prénom</label>
            <input type="text" name="firstName" class="form-control">

            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control">

            <label for="mail">Adresse mail</label>
            <input type="email" name="mail" class="form-control">

            <input type="submit" class="btn btn-success m-3" value="Modifier">
        </form>
    </div>