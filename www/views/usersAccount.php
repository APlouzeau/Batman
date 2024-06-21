<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?><title>Comptes des utilisateurs</title>

<div class="container d-flex flex-column align-items-center">
    <table class="table">
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user->getFirstName() ?></td>
                    <td><?= $user->getname() ?></td>
                    <td><?= $user->getMail() ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="container d-flex flex-column align-items-center">
    <div class="col-10 col-md-6">
        <form action="<?= BASE_URL . 'addUser'; ?>" method="post">
            <label for="firstName">Prénom</label>
            <input type="text" name="firstName" class="form-control">

            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control">

            <label for="mail">Adresse mail</label>
            <input type="email" name="mail" class="form-control" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>

            <label class="form-label" for="role">Type</label>
            <select class="form-select" type="type" name="role" aria-label="Default select example">
                <?php foreach ($roleList as $role) { ?>
                    <option class="" value="<?= $role->getId() ?>"><?= $role->getRole() ?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" class="btn btn-success m-3" value="Créer utilisateur">
        </form>
    </div>
</div>

<?php
require_once APP_PATH . "/views/footer.php";
?>