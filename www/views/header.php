</head>
<?php
require_once "../controller/userManager.php";
$userManager = new UserManager();

?>

<body>
    <div class="container-fluid">

        <header>
            <h1 class="text-center"><a styles="none" href="views/index.php">B@TMAN</a></h1>
            <?php
            if ($_SESSION) {
            echo '<p class="text-end">Bonjour ' . $_SESSION['firstName'] . '</p>';
            
            ?><div class="50px d-flex flex-row-reverse">
                <a href="controller/disconnect.php?logout" type="button" class="btn btn-danger modifyEstimate align-item-center" id="modifyEstimate">Deconnexion</a>
                <a href="views/profile.php" type="button" class="btn btn-success modifyEstimate" id="modifyEstimate">Compte</a>
            </div>
            <?php } ?>
            <ul class="nav justify-content-around bg-primary">
                <?php
                if ($_SESSION) {
                ?>
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="views/customer.php">Devis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-light" href="#">Comptabilité</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-light" href="#">Résultats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Chantiers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ressources
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="views/products.php">Produits</a></li>
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