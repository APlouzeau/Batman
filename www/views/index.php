<?php
define("BASE_URL", "/www");
require_once "../views/head.php";
?>

<title>Accueil</title>

<?php
require_once "../views/header.php";
if (!$_SESSION){
    require_once "../views/connectUser.php";
}
require_once "../views/footer.php";
?>

