<body>
    <header>
        <h1 class="text-center text-light display-1 fw-bold"><a styles="none" href="<?= BASE_URL ?>">B@TMAN</a></h1>
        <div class="d-flex flex-column align-items-end me-3">
            <?php
            if ($_SESSION) {
                echo '<p class="text-end">Bonjour ' . $_SESSION['firstName'] . '</p>';
            ?>
                <div class="mb-1">
                    <?php
                    if ($_SESSION['role'] == 'Administrateur') {
                    ?>
                        <a href="<?= BASE_URL . 'usersAccount'; ?>" type="button" class="btn btn-success">Gestion utilisateurs</a>
                    <?php
                    }
                    ?>
                    <a href="<?= BASE_URL . 'profile'; ?>" type="button" class="btn btn-success">Compte</a>
                    <a href="<?= BASE_URL . 'logout'; ?>" type="button" class="btn btn-danger align-item-center">Deconnexion</a>
                </div>
        </div>

        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#"></a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if ($_SESSION) {
                            if ($_SESSION['role'] != 'Comptable' || $_SESSION['role'] != 'Assistant') {
                        ?>
                                <li class="nav-item" id="navEstimate">
                                    <a class="nav-link text-light" aria-current="page" href="<?= BASE_URL . 'estimate'; ?>">Devis</a>
                                </li>
                            <?php
                            }
                            if ($_SESSION['role'] == 'Comptable' || $_SESSION['role'] == 'Administrateur') {
                            ?>
                                <li class="nav-item" id="navAccountant">
                                    <a class="nav-link  text-light" href="<?= BASE_URL . 'accounting'; ?>">Comptabilité</a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="nav-item" id="navProjects">
                                <a class="nav-link text-light" href="<?= BASE_URL . 'projects'; ?>">Chantiers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="navRessources" href="<?= BASE_URL . 'products'; ?>">Produits</a>
                            </li>
                    </ul>
                <?php
                        }
                ?>
                </div>
            </div>
        </nav>

    <?php } ?>
    </header>