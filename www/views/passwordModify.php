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
        <form action="controller/passwordModifyController.php" method="post">

            <label for="oldPassword">Ancien mot de passe</label>
            <input type="password" name="oldPassword" class="form-control">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control">

            <label for="passwordVerify">Mot de passe</label>
            <input type="password" name="passwordVerify" class="form-control">

            <input type="submit" class="btn btn-success m-3" value="Modifier">
        </form>
    </div>