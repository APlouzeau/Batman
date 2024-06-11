<title>Profil</title>

<div class="container d-flex flex-column align-items-center">
    <div>
        <form action="<?= BASE_URL . 'updatePassword'; ?>" method="post">

            <label for="oldPassword">Ancien mot de passe</label>
            <input type="password" name="oldPassword" class="form-control">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control">

            <label for="passwordVerify">Mot de passe</label>
            <input type="password" name="passwordVerify" class="form-control">

            <input type="submit" class="btn btn-success m-3" value="Modifier">
        </form>
    </div>