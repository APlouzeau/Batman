<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Profil</title>


<div class="container">
    <form action="<?= BASE_URL . 'updateProfile'; ?>" method="post" class="work d-flex flex-column justify-content-center align-items-center ">
        <div>
            <label for="firstName">Prénom</label>
            <input type="text" name="firstName" class="form-control">
        </div>

        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div>
            <label for="mail">Adresse mail</label>
            <input type="email" name="mail" class="form-control">
        </div>

        <input type="submit" class="btn btn-success m-3" value="Modifier">
    </form>
</div>
<?php
require_once APP_PATH . "/views/footer.php";
?>