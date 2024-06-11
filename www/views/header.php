</head>

<body class="w-100">
    <header>
        <h1 class="text-center"><a styles="none" href="<?= BASE_URL ?>">B@TMAN</a></h1>
        <?php
        if ($_SESSION) {
            echo '<p class="text-end">Bonjour ' . $_SESSION['firstName'] . '</p>';
        ?>
            <div class="50px d-flex flex-row-reverse">
                <a href="<?= BASE_URL . 'logout'; ?>" type="button" class="btn btn-danger align-item-center">Deconnexion</a>
                <a href="<?= BASE_URL . 'profile'; ?>" type="button" class="btn btn-success">Compte</a>
                <a href="<?= BASE_URL . 'usersAccount'; ?>" type="button" class="btn btn-success">Gestion utilisateurs</a>
            </div>
        <?php } ?>
        <ul class="nav justify-content-around bg-primary">
            <?php
            if ($_SESSION) {
            ?>
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="<?= BASE_URL . 'estimate'; ?>">Devis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-light" href="<?= BASE_URL . 'accounting'; ?>">Comptabilité</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= BASE_URL . 'projects'; ?>">Chantiers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ressources
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= BASE_URL . 'products'; ?>">Produits</a></li>
                        <li><a class="dropdown-item" href="#">Terrasses</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">DTU</a></li>
                    </ul>
                </li>
        </ul>
    <?php
            }


    ?>
    </header>
    <div style="min-height: 50em">