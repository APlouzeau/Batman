<?php

require_once APP_PATH . "/models/entities/productByTaskModel.php";
require_once APP_PATH . "/models/entities/PDOServer.php";
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

    public function situationAdvance($idTask, $row)
    {
        $req = $this->db->prepare('SELECT situation FROM productByTask WHERE idTask = :idTask AND row = :row');
        $req->bindValue(":idTask", $idTask, PDO::PARAM_INT);
        $req->bindValue(":row", $row, PDO::PARAM_INT);
        $situation = $req->fetch();
        return $situation;
    }
}
