<div class="container d-flex align-items-center w-25" style="min-height: 50em">
    <!--     <div class="container input-group mb-3">
        <input type="text" class="form-control" placeholder="Nom du client" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">Rechercher</span>
    </div> -->
    <form method="get" class="container" action="<?= BASE_URL . 'newEstimate'; ?>">
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
require_once APP_PATH . "/views/footer.php";


?>