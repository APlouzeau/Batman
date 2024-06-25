<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Profil</title>

<h2 class="text-center text-uppercase mt-5">Compte</h2>
<div class="work container d-flex flex-column justify-content-center align-items-center col-4">
    <table class="table table-responsive">
        <tbody>
            <tr class="text-center">
                <td><?= $user->getFirstName() ?></td>
                <td><?= $user->getname() ?></td>
                <td><?= $user->getMail() ?></td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="<?= BASE_URL . 'updateProfile'; ?>" class="btn btn-warning">Modifier Profil</a>
        <a href="<?= BASE_URL . 'updatePassword'; ?>" class="btn btn-danger">Modifier mot de passe</a>
    </div>
</div>

<?php

require_once APP_PATH . "/views/footer.php";
