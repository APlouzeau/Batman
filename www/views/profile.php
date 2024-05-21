<title>Profil</title>

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
        <a href="<?= BASE_URL . 'updateProfile'; ?>" class="btn btn-warning">Modifier Profil</a>
        <a href="<?= BASE_URL . 'updatePassword'; ?>" class="btn btn-danger">Modifier mot de passe</a>
    </div>
</div>
<?php

require_once APP_PATH . "/views/footer.php";
