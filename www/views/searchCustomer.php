<?php
define("BASE_URL", "/EYOSOP");
require_once "../views/head.php";
?>

<title>Recherche Client</title>

<?php
require_once "../views/header.php";
require_once "../controller/customersManager.php";
require_once "../models/customersModel.php";

$newCustomersManager = new CustomersManager();
$customerList = $newCustomersManager->getAllCustomers();
$link = '';
var_dump($link);
if ($_GET) {
    $link = '../views/newEstimate.php?id=' . $_GET["id"];
    header("Location:$link");
}



?>
<div class="container d-flex align-items-center w-25" style="min-height: 50em">
    <!--     <div class="container input-group mb-3">
        <input type="text" class="form-control" placeholder="Nom du client" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">Rechercher</span>
    </div> -->
    <form method="get" class="container">
        <select class="form-select mb-3" aria-label="Default select example" name="id">
            <?php
            foreach ($customerList as $customer) :
            ?>
                <option value="<?= $customer->getId() ?>"><?= $customer->getNameCustomer() ?></option>
            <?php
            endforeach
            ?>
        </select>
        <div class="mb-3 text-center">
            <input type="submit" class="btn btn-primary-success" class="btn btn-primary">
        </div>
    </form>
</div>
<script src="../JS/searchCustomer.js"></script>
<?php
require_once "../views/footer.php";


?>