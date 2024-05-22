<?php

require_once APP_PATH . "/models/productByTaskModel.php";
require_once APP_PATH . "/models/PDOServer.php";
class productByTaskManager extends PDOServer
{
    public function addProductByTask(ProductByTask $productByTask)
    {
        $req = $this->db->prepare("INSERT INTO productByTask (idProduct, idTask, quantityProduct, unitPriceProduct) VALUE (idProduct, idTask, quantityProduct, unitPriceProduct)");
        $req->bindValue("idProduct", $productByTask->getIdProduct(), PDO::PARAM_INT);
        $req->bindValue("idTask", $productByTask->getIdTask(), PDO::PARAM_INT);
        $req->bindValue("quantityProduct", $productByTask->getQuantityProduct(), PDO::PARAM_INT);
        $req->bindValue("unitPriceProduct", $productByTask->getUnitPriceProduct(), PDO::PARAM_INT);
        $req->execute();
    }
}
