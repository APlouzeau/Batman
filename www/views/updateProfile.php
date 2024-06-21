<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>
<title>Profil</title>


<div class="col-8 col-md-4 col-lg-3 col-xl-2">
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
<?php
require_once APP_PATH . "/views/footer.php";
?>