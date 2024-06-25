<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?><title>Comptes des utilisateurs</title>
<h3 class="text-center text-uppercase mt-5 mb-5">liste des utilisateurs</h3>
<div class="work container col-12 col-lg-8 col-xl-5">
    <div class="d-flex align-items-center">
        <table class="table col-2 ">
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr class="text-center">
                        <td><?= $user->getFirstName() ?></td>
                        <td><?= $user->getname() ?></td>
                        <td><?= $user->getMail() ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <h3 class="text-center text-uppercase mt-5 mb-5">ajout de nouvel utilisateur</h3>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center ">
            <form action="<?= BASE_URL . 'addUser'; ?>" method="post" class="col-8 col-md-6  col-xxl-4">
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
                <input type="submit" class="btn btn-success mt-3" value="Créer utilisateur">
            </form>
        </div>
    </div>
</div>

<?php
require_once APP_PATH . "/views/footer.php";
?>