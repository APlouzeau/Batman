<?php
require_once "../views/head.php";
require_once "../views/header.php";
require_once "../models/userModel.php";
require_once "../controller/userManager.php";

$userManager = new UserManager();

?>

<title>Profil</title>

<?php
require_once "../views/header.php";
?>

<div class="container d-flex flex-column align-items-center">
    <div>
        <form action="controller/updateController.php" method="post">
            <label for="firstName">Prénom</label>
            <input type="text" name="firstName" class="form-control">

            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control">

            <label for="mail">Adresse mail</label>
            <input type="email" name="mail" class="form-control">

            <input type="submit" class="btn btn-success m-3" value="Modifier">
        </form>
    </div>