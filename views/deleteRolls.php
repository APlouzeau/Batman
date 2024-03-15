<?php
define("BASE_URL", "/EYOSOP");
require_once "./head.php";
?>

<title>Ajout de nouveau rouleau</title>

<?php
require_once "./header.php";
require_once "../controller/rollsManager.php";

$rollsManager = new RollsManager();
$rollsManager->deleteRolls($_GET["id"]);

?>


<?php
require_once "../views/footer.php";
