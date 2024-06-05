<div class="container d-flex align-items-center" style="min-height: 50em">

    <form method="get" class="container" action="<?= BASE_URL . 'newEstimate'; ?>">
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
<script src="../JS/searchCustomer.js"></script>
<?php
require_once APP_PATH . "/views/footer.php";


?>