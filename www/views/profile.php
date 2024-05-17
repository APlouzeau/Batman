<?php
require_once "../views/head.php";
require_once "../views/header.php";
require_once "../models/userModel.php";
require_once "../controller/userManager.php";

$userManager = new UserManager();
$user = $userManager->getSelfUser($_SESSION['id']);
?>

<title>Profil</title>

<?php
require_once "../views/header.php";
?>

<div class="container d-flex flex-column align-items-center">
    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td><?= $user->getFirstName() ?></td>
                    <td><?= $user->getname() ?></td>
                    <td><?= $user->getMail() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <a href="views/updateProfile.php" class="btn btn-warning">Modifier Profil</a>
        <a href="views/passwordModify.php" class="btn btn-danger">Modifier mot de passe</a>
    </div>
</div>
<?php

require_once "../views/footer.php";



