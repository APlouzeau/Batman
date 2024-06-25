<?php
require_once APP_PATH . "/views/head.php";
require_once APP_PATH . "/views/header.php";
?>

<h3 class="text-center text-uppercase mt-5">Selection du client</h3>
<div class="work d-flex">
    <div class="container d-flex align-items-center" ">
        <form method=" get" class="container" action="<?= BASE_URL . 'newEstimate'; ?>">
        <div class="col-9 col-md-5 col-lg-4 col-xl-3 m-auto">
            <select class="form-select mb-3 " aria-label="Default select example" name="id">
                <?php
                foreach ($customerList as $customer) :
                ?>
                    <option value="<?= $customer->getId() ?>"><?= $customer->getNameCustomer() ?></option>
                <?php
                endforeach
                ?>
            </select>
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-success" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/searchCustomer.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";


?>